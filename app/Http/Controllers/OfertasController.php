<?php

namespace App\Http\Controllers;

use App\Http\Resources\OfertaCollection;
use App\Models\Ofertas;
use App\Http\Resources\OfertaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OfertasController extends Controller
{
    public function index()
    {
        // return OfertaResource::collection(Ofertas::latest()->paginate());
        return new OfertaCollection(Ofertas::latest()->paginate());
    }

    public function store(Request $request)
    {
        try {
            $validator =  Validator::make($request->all(), [
                'nombre' => 'required|string|max:45|unique:ofertas',
                'estado' => 'required|integer|min:0|max:1',
            ]);
    
            if ($validator->fails()) {
                return response()->json(["status" => "error", "message" => $validator->errors()], 422);
            }
    
            $data = [
                'nombre'=> trim($request->nombre),
                'estado' => $request->estado
            ];
    
            Ofertas::create($data);
            return response()->json(["status" => "success"]);
            
        } catch (\Throwable $th) {
            return response()->json(["status" => "error", "message" => $th->getMessage()]);
        }
        
    }

    public function show($id)
    {
        return new OfertaResource(Ofertas::find($id));
    }

}
