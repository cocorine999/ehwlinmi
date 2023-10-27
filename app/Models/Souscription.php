<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Souscription extends Model
{
  use SoftDeletes;

  protected $guarded = [];
  protected $with = ['contrat', 'primes'];

  public function contrat()
  {
    return $this->belongsTo('App\Models\Contrat');
  }

  public function primes()
  {
    return $this->hasMany('App\Models\Primes');
  }

  public function statut_souscriptions()
  {
    return $this->belongsToMany('App\Models\StatutSouscription', 'souscription_statut_souscription')->withPivot('souscription_id', 'statut_souscription_id', 'user_id', 'motif')->withTimestamps();
  }

  //scopes
  public function scopeTermine($query)
  {
    return $query->where('statut', 'Termine');
  }

  public function scopeIsValide($query)
  {
    return $query->whereIn('statut', ['Valide', 'Attente de paiement'])->get();
  }

  // retourne la date d'effet si le contrat est valide (validation du contrat)
  public function getDateEffetAttribute()
  {
    // $validated = $this->statut_souscriptions->where('label', 'Valide')->first();
    return $this->primes->count() ? $this->primes->first()->created_at : '';
  }


  // donne le retard en mois pour tout une souscription
  public function getRetardEnMoisAttribute()
  {
    $nombreMoisTotalAujourdhui = Carbon::now()->diffInMonths($this->DateEffet);
    $totalPrimesPayees = $this->primes->count();
    if ($totalPrimesPayees < $nombreMoisTotalAujourdhui) {
      return $nombreMoisTotalAujourdhui - $totalPrimesPayees;
    } else {
      return 0;
    }
  }


  // donne le retard en mois pour tout une souscription
  public function getRetardEnJoursAttribute()
  {
    $nombreMoisTotalAujourdhui = Carbon::now()->diffInMonths($this->DateEffet);
    $totalPrimesPayees = $this->primes->count();
    if ($totalPrimesPayees < $nombreMoisTotalAujourdhui) {
      $jours = Carbon::now()->diffInDays($this->DateEffet->addMonths($totalPrimesPayees));
      return $jours;
    } else {
      return 0;
    }
  }
}
