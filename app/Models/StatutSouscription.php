<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatutSouscription extends Model
{
    use SoftDeletes;

    public function souscriptions()
    {
        return $this->belongsToMany('App\Models\Souscription', 'souscription_statut_souscription')->withPivot('souscription_id', 'statut_souscription_id', 'user_id', 'motif')->withTimestamps();
    }
}
