<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'Num_room',
        'image',
        'description',
        'price',
        'reserv_id'
        
    ];

    public function reservation(){
        return $this->belongsTo(Reservation::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }
}
