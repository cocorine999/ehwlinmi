<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marchand extends Model
{
  use SoftDeletes;

  protected $guarded = [];

  public function users()
  {
    return $this->morphToMany('App\User', 'userable');
  }

  public function getUserAttribute()
  {
    return $this->users->first();
  }

  public function super_marchands()
  {
    return $this->belongsToMany('App\Models\SuperMarchand', 'marchand_super_marchand')->withPivot('super_marchand_id', 'marchand_id', 'active');
  }

  public function clients()
  {
    return $this->belongsToMany('App\Models\Client', 'marchand_client')->withPivot('contrat_id');
  }

  public function contrats()
  {
    return $this->belongsToMany('App\Models\Contrat', 'contrat_marchand')->withPivot('contrat_id', 'marchand_id', 'active');
  }

  public function active_contrats()
  {
    return $this->belongsToMany('App\Models\Contrat', 'contrat_marchand')->withPivot('contrat_id', 'marchand_id', 'active')->wherePivot('active', 1);
  }

  public function old_contrats()
  {
    return $this->belongsToMany('App\Models\Contrat', 'contrat_marchand')->withPivot('contrat_id', 'marchand_id', 'active')->wherePivot('active', 0);
  }

  public function prospects()
  {
    return $this->hasMany('App\Models\Prospect');
  }


  public function getActualSuperMarchandsAttribute()
  {
    return $this->super_marchands->where('pivot.active', '=', true);
  }

  public function getOldSuperMarchandsAttribute()
  {
    return $this->super_marchands->where('pivot.active', '=', false);
  }

  public function getActualContratsAttribute()
  {
    return $this->contrats->where('pivot.active', '=', true);
  }

  public function getOldContratsAttribute()
  {
    return $this->contrats->where('pivot.active', '=', false);
  }


  public function scopeReference($query,$reference)
  {
    return $query->where('reference', $reference)->get();
  }


  public function scopeNom($query,$key)
  {
    return  $query->orWhere("user.nom",'LIKE',"$key");//->orWhere("user.nom",'LIKE',$key);
  }


  public function scopeReferences($query,$key)
  {
    return $query->where(function ($query) use ($key){
      $query->where("reference",'=',"$key");//->orWhere("nom",'LIKE',"$key");//where('statut', 'Attente de paiement');
    });
    return  $query->where("reference",'=',$key)->orWhere("user.nom",'LIKE',$key);

    return $query->all()->where(function ($query) use ($key) {
      $query->where("reference",'=',$key)->orWhere("user.nom",'LIKE',$key);//where('statut', 'Attente de paiement');
    });
  }

}
