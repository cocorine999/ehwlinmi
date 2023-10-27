<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Contrat extends Model
{
  use SoftDeletes;

  protected $guarded = [];
  protected $with = ['client', 'assure', 'beneficiaires'];

  public function client()
  {
    return $this->belongsTo('App\Models\Client');
  }

  public function assure()
  {
    return $this->belongsTo('App\Models\Assure');
  }

  public function assures()
  {
    return $this->belongsToMany('App\Models\Assure', 'assure_contrat')->withPivot('assure_id', 'contrat_id', 'taux');
  }
  
  public function marchands()
  {
    return $this->belongsToMany('App\Models\Marchand', 'contrat_marchand')->withPivot('contrat_id', 'marchand_id', 'active');
  }

  public function beneficiaires()
  {
    return $this->belongsToMany('App\Models\Beneficiaire', 'contrat_beneficiaire')->withPivot('contrat_id', 'beneficiaire_id');
  }

  public function fichiers()
  {
    return $this->morphMany('App\Models\Fichier', 'fichierable');
  }

  public function souscriptions()
  {
    return $this->hasMany('App\Models\Souscription', 'contrat_id');
  }

  public function sinistre()
  {
    return $this->hasOne('App\Models\Sinistre');
  }

  public function statut_souscriptions()
  {
    return $this->belongsToMany('App\Models\StatutSouscription', 'souscription_statut_souscription')->withPivot('souscription_id', 'statut_souscription_id', 'user_id', 'motif')->withTimestamps();
  }

  public function getPrimesAttribute()
  {
    return $this->souscriptions->last()->primes;
  }

  public function cprimes()
  {
    return $this->hasManyThrough(Primes::class, Souscription::class);
  }

  public function getPremierePrimeAttribute()
  {
    if ($this->primes->count()) {
      return $this->primes->first()->created_at;
    } else {
      return null;
    }
  }

  public function getDateEffetAttribute()
  {
    return $this->souscriptions->last()->dateEffet;
  }

  public function getDateExpirationAttribute()
  {
    return $this->souscriptions->last()->primes->first()->created_at->addYear();
  }


  public function getStatutAttribute()
  {
    #$this->souscriptions->last()->update(['statut' => "Annulé"]);
    #dd($this->souscriptions);
    return $this->souscriptions->last()->statut;
  }

  public function getStatutsAttribute($value)
  {
    return $this->souscriptions->count();
    # return $this->souscriptions->last()->statut_souscriptions;
  }

  public function getActualMarchandsAttribute()
  {
    return $this->marchands->where('pivot.active', '=', true);
  }

  public function getOldMarchandsAttribute()
  {
    return $this->marchands->where('pivot.active', '=', false);
  }

  public function getReponseQuestionMedicalAttribute()
  {
    $selection = '';
    if ($this->q1 == 1) {
      $selection .= "  1   ";
    }
    if ($this->q2 == 1) {
      $selection .= "  2   ";
    }
    if ($this->q3 == 1) {
      $selection .= "  3   ";
    }
    if ($this->q4 == 1) {
      $selection .= "  4   ";
    }
    if ($this->q5 == 1) {
      $selection .= "  5   ";
    }

    return $selection;
  }



  public function getDelectableAttribute()
  {
    if ($this->souscriptions->count() === 1 && in_array($this->souscriptions->last()->statut, ['Attente de paiement'], true)) {
      $nombreJoursTotalAujourdhui = Carbon::now()->diffInDays($this->created_at);
      $delai = 30; //
      if ($nombreJoursTotalAujourdhui > $delai) {
        return true;
      }
      //return true;
    } else {
      return false;
    }
  }


  //scopes
  public function scopeAttentePaiement($query)
  {
    $statut = StatutSouscription::whereLabel('Attente de paiement')->get();
    return $query->whereHas('souscriptions', function ($query) use ($statut) {
      $query->where('statut', 'Attente de paiement');
    });
  }

  public function scopeReference($query, $reference)
  {
    return $query->where('reference', $reference)->get();
  }


  // donne le retard en mois pour tout une souscription
  public function getRetardEnJoursAttribute()
  {
    return $this->souscriptions->last()->retardEnJours;
  }


  // public function getRegimes() {
  //     $user = [];
  //     foreach (Auth::user()->regimeEconomiques as $r){
  //         array_push($user, ['nom'=>$r->nom]);
  //     }
  //     return array_column($user, 'nom');
  // }

  // public function hasRegime($regime) {
  //     return in_array($regime, $this->getRegimes());
  // }

}
