<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commune extends Model
{
    use SoftDeletes;

    protected $guarded =[];

    public function departement()
    {
        return $this->belongsTo('App\Models\Departement');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
