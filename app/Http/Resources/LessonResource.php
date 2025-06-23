<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\LessonReading;
use Illuminate\Support\Facades\Auth;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content,
            'id_categorie' => $this->id_categorie,
            'ceated_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_read' => $request->user() ? LessonReading::where('id_lesson', $this->id)
                                            ->where('id_user', $request->user()->id)
                                            ->exists() : false,
        ];
    }
}
