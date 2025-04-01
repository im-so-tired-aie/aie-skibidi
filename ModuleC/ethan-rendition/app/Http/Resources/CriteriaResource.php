<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CriteriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "category_id" => $this->category_id,
            "programme_id" => $this->programme_id,
            "required_hours" => $this->required_hours,
            "required_duration" => $this->required_duration,
            "required_project" => $this->required_project,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "category" => $this->category,
            "programme" => $this->programme
        ];
    }
}
