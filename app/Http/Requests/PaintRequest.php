<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaintRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'shape_ids' => 'array',
        ];
    }
}
