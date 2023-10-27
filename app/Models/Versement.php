<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Versement extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'user_id','montant','motif','created_by',
    ];

    // public function getFromAttribute($value){
    //   $user = User::find($value);
    //   return $user->full_name." ".$user->telephone;
    // }

    protected $with = [
        // 'user'
    ];

    protected $dates = ['updated_at', 'created_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedByAttribute($value)
    {
      $user = User::find($value);
        return $user;
    }

}
