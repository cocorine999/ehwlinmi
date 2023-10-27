<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fichier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'label', 'nom', 'contrat_id'
    ];
    
    public function contrat()
    {
        return $this->belongsTo('App\Models\Contrat');
    }

    /**
     * Get the owning fichierable model.
     */
    public function fichierable()
    {
        return $this->morphTo();
    }


}
