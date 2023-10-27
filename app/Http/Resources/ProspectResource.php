<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProspectResource extends JsonResource
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
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'telephone' => $this->telephone,
            'description' => $this->description,
            'created_at' => $this->created_at,  
            'deleted_at' => $this->deleted_at, 
            'updated_at' => $this->updated_at,
        ];
    }
}
