<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sms extends Model
{
    use SoftDeletes;

    protected $fillable = ['from', 'to', 'id', 'message', 'sent', 'response'];
    
    public function getFromAttribute($value){
        $user = User::find($value);
        return $user->full_name." ".$user->telephone;
    }
    
    public function getToAttribute($value){
        $user = User::find($value);
        return $user->full_name." ".$user->telephone;
    }
}
