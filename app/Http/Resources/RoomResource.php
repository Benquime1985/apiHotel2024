<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'title'=>$this->title,
            'room_numb'=>$this->room_numb,
            'image'=>$this->image,
            'description'=>$this->description,
            'price'=>$this->price,
            'reserv_id'=>$this->reserv_id,
            'reservation'=>$this->reservations, //?No apararece la imformacion reparar mas tarde(No es necesario)
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
