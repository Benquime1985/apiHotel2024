<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'serv_id',
        'room_id'
    ];
}
