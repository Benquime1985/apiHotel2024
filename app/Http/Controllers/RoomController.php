<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Room;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $room = new RoomCollection(Room::all());
            return ApiResponse::success('Listado de habitaciones con usuarios',201, $room);
        } catch (Exception $e){
            return ApiResponse::error('Error al obtener los roles',500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request -> validate([
                'room_numb' => 'required',
                'image' => ['nullable','image','mimes:jpeg,jpg,png,gif,svg,bmp','max:10240'],
                'description' => 'required|min:5|max:100',
                'price'  => 'required|min:2|max:10',
                'reserv_id' => 'required',
            ]);
            $room = new Room;
            $room->room_numb = $request->input('room_numb');
            $room->description = $request->input('description');
            $room->price = $request->input('price');
            $room->reserv_id = $request->input('reserv_id');
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $filename = pathinfo($filename, PATHINFO_FILENAME);
                $name_file = str_replace(" ", "_", $filename);
                $extension = $file->getClientOriginalExtension();
                $picture = date('His').'_'.$name_file.'.'.$extension; //?Nuevo nombre del archivo
                $file->move(public_path('uploads/'),$picture);
                $room->image='/uploads/'.$picture;
            }
            $room->save();
            return ApiResponse::success("Se ha creado la habitacion correctamente", 200, $room);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),404);
        } catch(Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            $room = new RoomCollection(Room::query()->where('id',$id)->get()); //select * from rols where id = $id;
            if ($room->isEmpty()) throw new ModelNotFoundException("Habitacion no encontrado");
            return ApiResponse::success( 'Información de la habitacion',200,$room);
        }catch(ModelNotFoundException $e) {
            return ApiResponse::error( 'No existe la habitacion solicitado',404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $room = Room::findOrFail($id);
            $request -> validate([
                'room_numb' => 'required',
                'image' => ['nullable','image','mimes:jpeg,jpg,png,gif,svg,bmp','max:10240'],
                'description' => 'required|min:5|max:100',
                'price'  => 'required|min:2|max:10',
                'reserv_id' => 'required',
            ]);
            $room = new Room;
            $room->room_numb = $request->input('room_numb');
            $room->description = $request->input('description');
            $room->price = $request->input('price');
            $room->reserv_id = $request->input('reserv_id');
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $filename = pathinfo($filename, PATHINFO_FILENAME);
                $name_file = str_replace(" ", "_", $filename);
                $extension = $file->getClientOriginalExtension();
                $picture = date('His').'_'.$name_file.'.'.$extension; //?Nuevo nombre del archivo
                $file->move(public_path('uploads/'),$picture);
                $room->image='/uploads/'.$picture;
            }
            $room->update();
            return ApiResponse::success("Se ha actualizado la habitacion correctamente", 200, $room);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),404);
        } catch(Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        } catch(ModelNotFoundException $e){
            return ApiResponse::error('No se encontro la Habitacion', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $room = Room::findOrFail($id);
            $room->delete();
            return ApiResponse::success("Se ha eliminado la habitacion de manera exitosa!!", 200);
        }catch (ModelNotFoundException $e) {
            return ApiResponse::error("La habitacion no existe",404);
        }catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }
}
