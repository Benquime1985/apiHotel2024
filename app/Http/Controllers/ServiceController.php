<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Service;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $services = new ServiceCollection(Service::all());
            return ApiResponse::success('Listado de servicios',201,$services);
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
            $service = new ServiceCollection(Service::query()->where('id',$id)->get()); //select * from rols where id = $id;
            if ($service->isEmpty()) throw new ModelNotFoundException("Servicio no encontrado");
            return ApiResponse::success( 'Información del servicio',200,$service);
        }catch(ModelNotFoundException $e) {
            return ApiResponse::error( 'No existe el servcio solicitado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}
