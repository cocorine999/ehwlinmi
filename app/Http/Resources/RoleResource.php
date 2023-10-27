<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Marchand;
use App\User;

class RoleResource extends JsonResource
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
		'name' => $this->name, 
		'guard_name' => $this->guard_name, 
		'created_at' => $this->created_at, 
		'deleted_at' => $this->deleted_at,
		'updated_at' => $this->updated_at,
        ];
    }
}
