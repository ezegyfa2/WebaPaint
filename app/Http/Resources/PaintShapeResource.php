<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaintShapeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'coordinate_x' => $this->shape_coordinate_x,
            'coordinate_y' => $this->shape_coordinate_y,
        ];
        $shapeResource = new ShapeResource($this->shape);
        return array_merge($data, $shapeResource->toArray($request));
    }
}
