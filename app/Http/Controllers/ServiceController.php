<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceCollection;
use App\Http\Responses\ApiResponse;
use App\Models\Service;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
        try{
            $request -> validate([
                'name' => 'required|min:5|max:36',
                'image' => ['nullable','image','mimes:jpeg,jpg,png,gif,svg,bmp','max:10240'],
                'description' => 'required|min:5|max:100',
                'price'  => 'required|min:2|max:10',
            ]);
            $service = new Service;
            $service->name = $request->input('name');
            $service->description = $request->input('description');
            $service->price = $request->input('price');
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $filename = pathinfo($filename, PATHINFO_FILENAME);
                $name_file = str_replace(" ", "_", $filename);
                $extension = $file->getClientOriginalExtension();
                $picture = date('His').'_'.$name_file.'.'.$extension; //?Nuevo nombre del archivo
                $file->move(public_path('uploads/'),$picture);
                $service->image='/uploads/'.$picture;
            }
            $service->save();
            return ApiResponse::success("Se ha creado el servicio correctamente", 200, $service);
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
    public function update(Request $request, $id)
    {
        try{
            $service = Service::findOrFail($id);
            $request -> validate([
                'name' => 'required|min:5|max:36',
                'image' => ['nullable','image','mimes:jpeg,jpg,png,gif,svg,bmp','max:10240'],
                'description' => 'required|min:5|max:100',
                'price'  => 'required|min:2|max:10',
            ]);
            $service->name = $request->input('name');
            $service->description = $request->input('description');
            $service->price = $request->input('price');
            if ($request->hasFile('image')){
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $filename = pathinfo($filename, PATHINFO_FILENAME);
                $name_file = str_replace(" ", "_", $filename);
                $extension = $file->getClientOriginalExtension();
                $picture = date('His').'_'.$name_file.'.'.$extension; //?Nuevo nombre del archivo
                $file->move(public_path('uploads/'),$picture);
                $service->image='/uploads/'.$picture;
            }
            $service->save();
            return ApiResponse::success("Se ha actualizado el servicio correctamente", 200, $service);
        } catch(ValidationException $e){
            return ApiResponse::error($e->getMessage(),404);
        } catch(Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $service = Service::findOrFail($id);
            $service->delete();
            return ApiResponse::success("Se ha eliminado el servicio de manera exitosa!!", 200);
        }catch (ModelNotFoundException $e) {
            return ApiResponse::error("El servicio no existe",404);
        }catch (Exception $e){
            return ApiResponse::error($e->getMessage(),500);
        }
    }
}
