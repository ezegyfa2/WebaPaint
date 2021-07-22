<?php

namespace App\Http\Resources;

use App\Models\ShapeProperty;
use App\Models\ShapePropertyType;
use Illuminate\Http\Resources\Json\JsonResource;

class ShapeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $responseData = [
            'color' => $this->color->name,
            'type' => $this->shapeType->name,
        ];
        foreach ($this->shapeProperties as $property) {
            $responseData[strtolower($property->shapePropertyType->name)] = $property->value;
        }
        return $responseData;
    }
}
