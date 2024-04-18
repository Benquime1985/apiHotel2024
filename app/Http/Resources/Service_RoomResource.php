<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Service_RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'serv_id'=>$this->serv_id,
            'service'=>$this->service,   //?No apararece la imformacion reparar mas tarde(No es necesario)
            'room_id'=>$this->room_id,
            'room'=>$this->room,        //?No apararece la imformacion reparar mas tarde(No es necesario)
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
