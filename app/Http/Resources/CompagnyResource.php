<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompagnyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => $this->logo,
            'siret' => $this->siret,
            'mail_manager' => $this->mail_manager,
            'telephone_manager' => $this->telephone_manager,
            'adresse_siege' => $this->adresse_siege,
        ];
    }
}
