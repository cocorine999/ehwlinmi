<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuperMarchand extends Model
{
    use SoftDeletes;

    protected $guarded =[];

    public function users()
    {
        return $this->morphToMany('App\User', 'userable');
    }

    public function marchands()
    {
        return $this->belongsToMany('App\Models\Marchand', 'marchand_super_marchand')->withPivot( 'super_marchand_id', 'marchand_id', 'active' );
    }

    public function direction()
    {
        return $this->belongsTo('App\Models\Direction');
    }

    public function cautions()
    {
        return $this->hasMany('App\Models\Caution');
    }

    public function getActualMarchandsAttribute(){
        return $this->marchands->where('pivot.active', '=', true);
    }

    public function getOldMarchandsAttribute(){
        return $this->marchands->where('pivot.active', '=', false);
    }

    protected function getContrats()
    {
        $contrats = [];
        foreach ($this->marchands as $marchand)
        {
            foreach ($marchand->contrats as $c)
            {
                array_push($contrats, $c);
            }
        }
        return $contrats;
    }

}
