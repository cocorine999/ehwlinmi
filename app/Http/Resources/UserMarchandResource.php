<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserMarchandResource extends JsonResource
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

            'id'                    => $this->id,
            'reference'             => $this->reference,
            'entreprise'            => $this->entreprise,
            'registre'              => $this->registre,
            'personne'              => $this->personne,
            'user'                  =>  $this->users == null ? null : new ProfilResource($this->users()->first()),'created_at' => $this->created_at,  'deleted_at' => $this->deleted_at, 'updated_at' => $this->updated_at,
        ];
    }
}
