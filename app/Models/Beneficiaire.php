<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beneficiaire extends Model
{
    use SoftDeletes;

    protected $guarded =[];
    
    public function users()
    {
        return $this->morphToMany('App\User', 'userable');
    }

    public function contrats()
    {
        return $this->belongsToMany('App\Models\Contrat', 'contrat_beneficiare')->withPivot( 'contrat_id', 'beneficiaire_id' );
    }
}
