<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReservationCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Reservation;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reservation = new ReservationCollection(Reservation::all());
            return ApiResponse::success('Listado de la reservaciones',200,$reservation);
        } catch(Exception $e) {
            return ApiResponse::error('Error en la consulta',404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request -> validate([
                'name' => 'required|min:3|max:45',
                'date_arrive' => 'required',
                'date_output' => 'required',
                'Num_pers' => 'required|min:1|max:2',
                'user_id'  => 'required',
            ]);
            $reservation = Reservation::create($request->all());
            return ApiResponse::success("Se ha creado la reservacion correctamente", 200, $reservation);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $reservation = new ReservationCollection(Reservation::query()->where('id',$id)->get());
            if ($reservation->isEmpty()) throw new ModelNotFoundException("Reservacion no encontrada");
            return ApiResponse::success('Informacion de las reservaciones',200,$reservation);
        }catch (ModelNotFoundException $e) {
            return ApiResponse::error('No se encuentra la Reservacion',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
