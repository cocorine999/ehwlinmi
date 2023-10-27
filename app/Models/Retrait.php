<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Retrait extends Model
{

  protected $fillable = [
    'montant',
    'motif',
    'observation',
    'decision',
    'active',
    'handle_at',
    'created_by_user_id',
    'handled_by_user_id'
  ];

  protected $dates = ['created_at', 'updated_at'];

  // public function related_to()
  // {
  //     return $this->belongsTo(User::class, 'related_user_id', 'id');
  // }

  public function created_by()
  {
    return $this->belongsTo(User::class, 'created_by_user_id', 'id');
  }

  public function handled_by()
  {
    return $this->belongsTo(User::class, 'handled_by_user_id', 'id');
  }
}
