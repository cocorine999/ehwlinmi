<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Models\Assure;

class UserContratResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  $this  == null ? null : [
            'id'                    => $this->id == null ? "null" : $this->id ,
            'reference'             => $this->reference,
            'q1'                    => $this->q1 == 1 ? true : false,
            'q2'                    => $this->q2 == 1 ? true : false,
            'q3'                    => $this->q3 == 1 ? true : false,
            'q4'                    => $this->q4 == 1 ? true : false,
            'q5'                    => $this->q5 == 1 ? true : false,'created_at' => $this->created_at,  'deleted_at' => $this->deleted_at, 'updated_at' => $this->updated_at,
            
            'client'                =>  $this->client == null ? null : ['id' => $this->client->id, 'created_at' => $this->client->created_at, 'deleted_at' => $this->client->deleted_at, 'updated_at' => $this->client->updated_at,'user' => new ProfilResource($this->client->users()->first())],
            
            'assure'                => $this->assure == null ? null : ['id' => $this->assure->id, 'created_at' => $this->assure->created_at, 'deleted_at' => $this->assure->deleted_at, 'updated_at' => $this->assure->updated_at,'user' => new ProfilResource($this->assure->users()->first())],
            
            'beneficiaires'         => $this->beneficiaires == '[]' ? null : collect($this->beneficiaires)->map(function ($beneficiaire){
                                          return $beneficiaire == null ? null : ['id' => $beneficiaire->id,'label' => $beneficiaire->label,'taux' => $beneficiaire->taux,'type' => $beneficiaire->type, 'created_at' => $beneficiaire->created_at, 'deleted_at' => $beneficiaire->deleted_at, 'updated_at' => $beneficiaire->updated_at,'user' => new ProfilResource($beneficiaire->users()->first())];
                                        }),
                                        
            'souscriptions'         => [['id' => $this->souscriptions->last()->id,  'date_effet' => $this->souscriptions->last()->date_effet,'created_at' => $this->souscriptions->last()->created_at, 'deleted_at' => $this->souscriptions->last()->deleted_at, 'updated_at' => $this->souscriptions->last()->updated_at,'primes' => $this->souscriptions->last()->primes,'statut' => $this->souscriptions->last()->statut,]],
                                        
         /*    'souscriptions'         => $this->souscriptions == '[]' ? null : collect($this->souscriptions)->map(function ($souscription){
                                          return $souscription == null ? null : ['id' => $souscription->id,  'date_effet' => $this->date_effet,'created_at' => $souscription->created_at, 'deleted_at' => $souscription->deleted_at, 'updated_at' => $souscription->updated_at,'primes' => $souscription->primes,'statut' => $souscription->statut,];
                                        }),*/
                                        
            'marchands'         => $this->marchands == '[]' ? null : collect($this->marchands)->map(function ($marchand){
                                          return $marchand == null ? null : ['id' => $marchand->id == null ? null : $marchand->id, 'reference' => $marchand->reference,'created_at' => $marchand->created_at, 'deleted_at' => $marchand->deleted_at, 'updated_at' => $marchand->updated_at,'user' => new ProfilResource($marchand->users()->first())];
                                        }),
                                        
            'assures'         => $this->assures == '[]' ? null : collect($this->assures)->map(function ($assure){
                                          return $assure == null ? null : ['id' => $assure->id == null ? null : $assure->id, 'taux' => $assure->taux,'created_at' => $assure->created_at, 'deleted_at' => $assure->deleted_at, 'updated_at' => $assure->updated_at,'user' => new ProfilResource($assure->users()->first())];
                                        }),
                                        
                                        
           /*'assures'         => [['id' => $this->assure->id == null ? null : $this->assure->id, 'created_at' => $this->assure->created_at, 'deleted_at' => $this->assure->deleted_at, 'updated_at' => $this->assure->updated_at,'user' => new ProfilResource($this->assure->users()->first())]],*/

      ];
    }
}
