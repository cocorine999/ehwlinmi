<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departement extends Model
{
    use SoftDeletes;

    protected $guarded =[];

    public function communes()
    {
        return $this->hasMany('App\Models\Commune');
    }

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\Models\Commune');
    }
}
