<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CalculatorResultResource extends JsonResource
{
    public function toArray($request)
    {
        ray($this);
        return [];
    }
}
