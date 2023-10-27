<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this == null ? null : [
          'id' => $this->id,
          'nom' => $this->nom,
          'prenom' => $this->prenom,
          'adresse' => $this->adresse,
          'telephone' => $this->telephone,
          'email' => $this->email,
          'sexe' => $this->sexe,
          'ifu' => $this->ifu,
          'profession' => $this->profession,
          'commune' => $this->commune,
          'situation_matrimoniale' => $this->situation_matrimoniale,
          'date_naissance' => $this->date_naissance,
          'actif' => $this->actif == 1 ? true : false,
      ];
    }
}
