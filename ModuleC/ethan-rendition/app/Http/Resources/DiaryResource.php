<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiaryResource extends JsonResource
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
            "title" => $this->title,
            "description" => $this->description,
            "organization" => $this->organization,
            "reflection" => $this->reflection,
            "status" => $this->status,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "hours" => $this->hours,
            "remarks" => $this->remarks,
            "enrolment_id" => $this->enrolment_id,
            "category_id" => $this->category_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "category" => $this->category
        ];
    }
}
