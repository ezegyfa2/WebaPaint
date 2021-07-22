<?php

namespace App\Http\Requests;

class CircleRequest extends ShapeRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $shapeRules = parent::rules();
        $rules = [
            'radius' => 'required|integer',
        ];
        return array_merge($shapeRules, $rules);
    }
}
