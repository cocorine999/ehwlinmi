<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Traits\HasWallets;
use Bavix\Wallet\Interfaces\Wallet;

use Auth;

class User extends Authenticatable implements Wallet
{
  use SoftDeletes, HasApiTokens, Notifiable, HasRoles, HasWallet, HasWallets;


  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'nom', 'prenom', 'telephone', 'email', 'sexe', 'ifu', 'date_naissance', 'situation_matrimoniale', 'adresse', 'password', 'commune_id', 'employeur', 'profession',  'banned_until'
  ];

  protected $with = [
    'wallet', 'direction', 'super_marchand', 'marchand', 'client', 'assure', 'beneficiaire', 'nsia', 'commune', 'roles'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  protected $dates = ['updated_at', 'created_at', 'deleted_at', 'email_verified_at', 'banned_until', 'date_naissance'];

  protected $username = 'telephone';

  # Accessors & Mutators
  public function getFullNameAttribute()
  {
    return "{$this->nom} {$this->prenom}";
  }

  public function getShortFullNameAttribute()
  {
    $myvalue = $this->prenom;
    $arr = explode(' ', trim($myvalue));
    return "{$this->nom} {$arr[0]}";
  }

  public function getNomAttribute($value)
  {
    return strtoupper($value);
  }

  public function getPrenomAttribute($value)
  {
    return ucwords($value);
  }

  public function getReferenceAttribute()
  {
    if ($this->hasRole('SuperMarchand')) {
      return $this->super_marchand->first()->reference;
    } elseif ($this->hasRole('Marchand')) {
      return $this->marchand->first()->reference;
    } else {
      return "Pas de référence";
    }
  }

  public function getTypePersonneAttribute()
  {
    if ($this->hasRole('SuperMarchand')) {
      return $this->super_marchand->first()->personne;
    } elseif ($this->hasRole('Marchand')) {
      return $this->marchand->first()->personne;
    } else {
      return "";
    }
  }


  # HERITAGE & RELATIONS
  public function itadmin()
  {
    return $this->morphedByMany('App\Models\Itadmin', 'userable');
  }

  public function direction()
  {
    return $this->morphedByMany('App\Models\Direction', 'userable');
  }

  public function super_marchand()
  {
    return $this->morphedByMany('App\Models\SuperMarchand', 'userable');
  }

  public function marchand()
  {
    return $this->morphedByMany('App\Models\Marchand', 'userable');
  }

  public function client()
  {
    return $this->morphedByMany('App\Models\Client', 'userable');
  }

  public function assure()
  {
    return $this->morphedByMany('App\Models\Assure', 'userable');
  }

  public function beneficiaire()
  {
    return $this->morphedByMany('App\Models\Beneficiaire', 'userable');
  }

  public function nsia()
  {
    return $this->morphedByMany('App\Models\Nsia', 'userable');
  }

  public function commune()
  {
    return $this->belongsTo('App\Models\Commune');
  }

  public function departement()
  {
    return $this->belongsTo('App\Models\Departement');
  }

  public function userDepartement()
  {
    return $this->hasOneThrough('App\Departement', 'App\Commune');
  }

  public function primes()
  {
    return $this->hasMany('App\Models\Primes');
  }

  public function mobile_money()
  {
    return $this->hasMany('App\Models\MobileMoney');
  }

  public function contrats()
  {
    if (Auth::user()->hasRole('Marchand')) {
      return Auth::user()->marchand->first()->contrats();
    }
    if (Auth::user()->hasRole('Client')) {
      return Auth::user()->client->first()->contrats();
    }
  }


  public function getContratListAttribute()
  {
    if ($this->hasRole('SuperMarchand')) {
      $contrats = [];
      if($this->marchands){
        foreach ($this->marchands as $marchand)
        {
            foreach ($marchand->contrats as $c)
            {
                array_push($contrats, $c);
            }
        }
      }
      return $contrats;
    }
    if ($this->hasRole('Marchand')) {
      return $this->marchand->first()->contrats();
    }
    if ($this->hasRole('Client')) {
      return $this->client->first()->contrats();
    }else {
      return null;
    }
  }


  public function getContratValidesAttribute() {
    $contrat_list = $this->contrat_list;
    $contrat_valides = [];

    if($contrat_list->count()){
      foreach ($contrat_list as $c)
      {
            dump($c);
          // if($c->souscriptions->last()->status !== 'ok') {
          //     array_push($contrat_valides, $c);
          // }
      }
    }

    return $contrat_valides;
  }

  // public function getMarchands() {
  //     $marchand = [];
  //     $client= Auth::user()->client->first();
  //     if($client){
  //         foreach ($client->contrats as $c){
  //             array_push($marchand, ['id'=>$c->marchand->id]);
  //         }
  //     }
  //     return array_column($marchand, 'id');
  // }

  // public function hasMarchand($marchand) {
  //     return in_array($marchand, $this->getMarchands());
  // }

  public function tickets()
  {
    return $this->hasMany(Ticket::class);
  }

  public function ticket_comments()
  {
    return $this->hasMany(TicketComment::class);
  }

}
