<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assure extends Model
{
    use SoftDeletes;

    protected $guarded =[];

    public function users()
    {
        return $this->morphToMany('App\User', 'userable');
    }

    public function client()
    {
      return $this->belongsTo('App\Models\Client');
    }

    public function contrats()
    {
      return $this->hasMany('App\Models\Contrat');
    }

    public function beneficiaires()
    {
        return $this->belongsToMany('App\Models\Beneficiaire', 'contrat_beneficiaire')->withPivot( 'contrat_id', 'beneficiaire_id' );
    }
}
