<?php

namespace App\Http\Controllers;

use App\Http\Resources\Service_RoomCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Service_Room;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ServiceRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $service__rooms = new Service_RoomCollection(Service_Room::all());
            return ApiResponse::success('Listado de servicios de la habitacion',201,$service__rooms);
        } catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
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
            $service__room = new Service_RoomCollection(Service_Room::query()->where('id',$id)->get()); //select * from rols where id = $id;
            if ($service__room->isEmpty()) throw new ModelNotFoundException("Servicios de la habitaccion no encontrado");
            return ApiResponse::success( 'Información del servicios de la habitacion',200,$service__room);
        }catch(ModelNotFoundException $e) {
            return ApiResponse::error( 'No existe el servcio de la habiatacion solicitado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service_Room $service_Room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service_Room $service_Room)
    {
        //
    }
}
