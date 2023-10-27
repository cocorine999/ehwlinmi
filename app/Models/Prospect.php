<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prospect extends Model
{
    use SoftDeletes;
 
    protected $fillable = ["nom", "prenom", "telephone", "description", "commune_id", "marchand_id"];

    public function commune(){
    	return $this->BelongsTo('App\Models\Commune');
    }

    public function marchand(){
        return $this->belongsTo('App\Models\Marchand');
    }
  

}
