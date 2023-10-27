<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileMoney extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    use SoftDeletes;

    protected $fillable = [
        'msisdn', 'operation_type', 'operateur', 'amount', 'response', 'response_code', 'response_msg', 'transref', 'firstname', 'lastname', 'narration', 'user_id',
    ];   
    
    public function user(){
        return $this->belongsTo('App\User');
    }

}
