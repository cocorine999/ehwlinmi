<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Primes extends Model
{
    use SoftDeletes;
 
    // protected $with = [
        
    // ];  

    protected $fillable = ['souscription_id', 'montant', 'user_id', 'c_first_marchand', 'c_marchand', 'c_smarchand', 'c_nsia', 'c_mms', 'date_prime'];

    public function souscription()
    {
        return $this->belongsTo('App\Models\Souscription');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    } 
}