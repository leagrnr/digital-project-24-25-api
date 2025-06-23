<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question,
            'anwsers' => $this->anwsers,
            'good_answer' => $this->good_answer,
            'id_quizz' => $this->id_quizz,
        ];
    }
}
