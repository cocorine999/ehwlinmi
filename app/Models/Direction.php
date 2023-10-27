<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direction extends Model
{
    use SoftDeletes;

    protected $guarded =[];
    
    public function users()
    {
        return $this->morphToMany('App\User', 'userable');
    }

    public function super_marchands(){
        return $this->hasMany('App\Models\SuperMarchand', 'super_marchand_id');
    }

}
