<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsuarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if(isset($this->id)){
            return [
                "id" => $this->id,
                "nombre" => $this->nombre,
                "email" => $this->email,
                "documento" => [
                    "id" => $this->tipo_documento,
                    "tipo" => ($this->tipo_documento == 1) ? 'Cédula de ciudadanía' : 'Tarjeta de identidad',
                    "numero" => $this->numero_documento,
                ]
            ];
        }

        return [];
    }
}
