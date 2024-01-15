<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlotResource extends JsonResource
{
    public function toArray($request): array
    {
        return [

            'id' => $this->id,
            'title' => 'Test',
            'description' => 'Test',
            'start' => $this->start_date,
            'end' => $this->end_date,
            'link' => ''
        ];
    }
}
