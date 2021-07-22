<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RectangleRequest extends ShapeRequest
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
            'height' => 'required|integer',
            'width' => 'required|integer',
        ];
        return array_merge($shapeRules, $rules);
    }
}
