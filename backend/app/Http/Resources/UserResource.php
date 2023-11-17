<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->createToken('Token')->plainTextToken,
            'id' => $this->id,
            'nama' => $this->nama,
            'email' => $this->email,
            'alamat' => $this->alamat,
            'no_hp' => $this->no_hp,
            'foto' => $this->foto,
            'active' => $this->active,
            'role' => $this->roles->pluck('name'),
        ];
    }
}
