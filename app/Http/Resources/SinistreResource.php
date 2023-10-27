<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SinistreResource extends JsonResource
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
            'id' => $this->sinistre->id,
            'statut' => $this->sinistre->statut,
            'description' => $this->sinistre->description,
            'date_sinistre' => $this->sinistre->date_sinistre,
            'contrat' => new UserContratResource($this),
        ];

        /*
            [
                'id' => $this->id,
                'statut' => $this->statut,
                'description' => $this->description,
                'date_sinistre' => $this->date_sinistre,
                'contrat' => new UserContratResource($this->contrat),
            ];
        */
    }
}
