<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TicketCategory extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at', ];

    protected $fillable = ['name', 'color', 'created_at', 'updated_at', 'deleted_at', ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
