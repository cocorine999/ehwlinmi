<?php

namespace App\Models;

use App\Scopes\AgentScope;
use App\Traits\Auditable;
use App\Notifications\CommentEmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Ticket extends Model
{
    use SoftDeletes;

    public $table = 'tickets';

    protected $appends = [
        'attachments',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at', ];

    protected $fillable = [
        'title',
        'content',
        'contrat_id',
        'related_user_id',
        'created_by_user_id',
        'assigned_to_user_id',
        'status_id',
        'priority_id',
        'category_id',
    ];

    public static function boot()
    {
        parent::boot();

        Ticket::observe(new \App\Observers\TicketActionObserver);

        static::addGlobalScope(new AgentScope);
    }

    public function related_user()
    {
        return $this->belongsTo(User::class, 'related_user_id', 'id');
    }

    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by_user_id', 'id');
    }

    public function corrected_by_user()
    {
        return $this->belongsTo(User::class, 'corrected_by_user_id', 'id');
    }

    public function contrat()
    {
        return $this->belongsTo(Contrat::class, 'contrat_id');
    }

    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class, 'status_id', 'id');
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'category_id', 'id');
    }

    public function assigned_to_user()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id', 'id');
    }

    public function scopeFilterTickets($query)
    {
        $query->when(request()->input('priority'), function($query) {
                $query->whereHas('priority', function($query) {
                    $query->whereId(request()->input('priority'));
                });
            })
            ->when(request()->input('category'), function($query) {
                $query->whereHas('category', function($query) {
                    $query->whereId(request()->input('category'));
                });
            })
            ->when(request()->input('status'), function($query) {
                $query->whereHas('status', function($query) {
                    $query->whereId(request()->input('status'));
                });
            });
    }

    public function sendCommentNotification($comment)
    {
        $users = \App\User::where(function ($q) {
                $q->whereHas('roles', function ($q) {
                    return $q->where('title', 'Agent');
                })
                ->where(function ($q) {
                    $q->whereHas('comments', function ($q) {
                        return $q->whereTicketId($this->id);
                    })
                    ->orWhereHas('tickets', function ($q) {
                        return $q->whereId($this->id);
                    });
                });
            })
            ->when(!$comment->user_id && !$this->assigned_to_user_id, function ($q) {
                $q->orWhereHas('roles', function ($q) {
                    return $q->where('title', 'Admin');
                });
            })
            ->when($comment->user, function ($q) use ($comment) {
                $q->where('id', '!=', $comment->user_id);
            })
            ->get();
        $notification = new CommentEmailNotification($comment);

        Notification::send($users, $notification);
        if($comment->user_id && $this->author_email)
        {
            Notification::route('mail', $this->author_email)->notify($notification);
        }
    }
}
