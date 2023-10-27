<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nsia extends Model
{
    use SoftDeletes;

    protected $guarded =[];
      
    public function users()
    {
        return $this->morphToMany('App\User', 'userable');
    }
    
    public function direction()
    {
        return $this->belongsTo('App\Models\Direction');
    }
}
