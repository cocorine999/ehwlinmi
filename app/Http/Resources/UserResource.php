<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use \Str;
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return $this == null ? null :  [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'adresse' => $this->adresse,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'sexe' => $this->sexe,
            'ifu' => $this->ifu,
            'profession' => $this->profession,
            'situation_matrimoniale' => $this->situation_matrimoniale,
            'date_naissance' => $this->date_naissance,
            'actif' => $this->actif == 1 ? true : false,
            'commune' => $this->commune,
            'wallet' => $this->wallet,
            'roles' => collect($this->roles)->map(function ($role){

            	$value = \Str::lower($role->name);
            	$result = null;
            	if($value == "supermarchand"){
            		$result = $this->super_marchand;
            	}
            	else if($value == "marchand"){
            		$result = $this->marchand ;
            	}
            	else if($value == "client"){
            		$result = $this->client;
            	}else{
                $result = $value;
              }


                                          return $role == null ? null : [
		'id' => $role->id,
		'name' => $role->name,
		'guard_name' => $role->guard_name,
		//'model' => $result,
		'created_at' => $role->created_at,
		'deleted_at' => $role->deleted_at,
		'updated_at' => $role->updated_at,
        ];
                                        }),

        ];



    }
}
