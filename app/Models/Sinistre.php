<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sinistre extends Model
{
    use SoftDeletes;
    
    protected $guarded =[];

    public function client(){
        return $this->belongsTo('App\Models\Client');
    }

    public function contrat(){
        return $this->belongsTo('App\Models\Contrat');
    }
        
    //to be checked
    public function fichiers()
    {
        return $this->morphMany('App\Models\Fichier', 'fichierable');
    }

}
