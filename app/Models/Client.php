<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $guarded =[];
    // protected $with =[ 'users' ];

    public function users()
    {
        return $this->morphToMany('App\User', 'userable');
    }

    public function contrats()
    {
      return $this->hasMany('App\Models\Contrat');
    }
    
    public function sinistres()
    {
      return $this->hasMany('App\Models\Sinistre');
    }

    public function marchands()
    {
        return $this->belongsToMany('App\Models\Marchand', 'marchand_client')->withPivot('contrat_id');
    }

    public function marchand()
    {
        return $this->belongsTo('App\Models\Marchand', 'marchand_id');
    }

    public function assures()
    {
      return $this->hasMany('App\Models\Assures');
    }
}
