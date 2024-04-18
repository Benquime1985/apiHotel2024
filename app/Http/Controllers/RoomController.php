<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Room;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $room = new RoomCollection(Room::all());
            return ApiResponse::success('Listado de roles con usuarios',201, $room);
        } catch (Exception $e){
            return ApiResponse::error('Error al obtener los roles',500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $room = new RoomCollection(Room::query()->where('id',$id)->get()); //select * from rols where id = $id;
            if ($room->isEmpty()) throw new ModelNotFoundException("Rol no encontrado");
            return ApiResponse::success( 'Información del rol',200,$room);
        }catch(ModelNotFoundException $e) {
            return ApiResponse::error( 'No existe el rol solicitado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
