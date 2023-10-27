<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class TicketComment extends Model
{
    use SoftDeletes;


    protected $dates = ['created_at', 'updated_at', 'deleted_at', ];

    protected $fillable = [
        'user_id',
        'ticket_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'author_name',
        'author_email',
        'comment_text',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
