<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsuarioResource;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UsuarioCollection;

class UsuariosController extends Controller
{
    public function index()
    {
        return new UsuarioCollection(Usuarios::latest()->paginate());
    }

    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|string|max:45',
            'email' => 'required|string|max:45',
            'tipo_documento' => 'required|integer|min:0|max:1',
            'numero_documento' => 'required|unique:usuarios',
            'id_oferta' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(["status" => "error", "message" => $validator->errors()], 422);
        }

        $data = [
            'nombre' => trim($request->nombre),
            'email' => trim($request->email),
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'ofertas_id' => $request->id_oferta,
        ];

        Usuarios::create($data);
        return response()->json(["status" => "success"]);
    }

    public function show($id)
    {
        return new UsuarioResource(Usuarios::find($id));
    }

}
