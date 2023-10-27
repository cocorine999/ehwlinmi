<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserContratSouscriptionResource extends JsonResource
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

          'id'                  => $this->id,
          'statut'              => $this->statut,
          'primes'              => $this->primes,
          'marchand'            => $this->marchand,
          'client'              => $this->client,
          'beneficiaires'       => UserResource::collection($this->beneficiaires),
        ];
    }
}
