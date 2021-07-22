<?php

namespace App\Http\Controllers;

use App\Http\Requests\RectangleRequest;
use App\Http\Requests\CircleRequest;
use App\Http\Resources\ShapeResource;
use App\Models\Shape;
use App\Models\ShapeType;
use Illuminate\Support\Facades\Auth;

class ShapeController extends Controller
{
    public function index() {
        return Shape::getCurrentUserItemIds();
    }

    public function getShape(int $id) {

        return new ShapeResource(Shape::find($id));
    }

    public function createCircle(CircleRequest $request) {
        $newCircle = new Shape([
            'color_id' => $request->get('color_id'),
            'shape_type_id' => ShapeType::getIdByName('Circle'),
            'user_id' => Auth::user()->id,
        ]);
        $newCircle->save();
        $newCircle->addProperty('Radius', $request->get('radius'));
        return new ShapeResource($newCircle);
    }

    public function createRectangle(RectangleRequest $request) {
        $newRectangle = new Shape([
            'color_id' => $request->get('color_id'),
            'shape_type_id' => ShapeType::getIdByName('Rectangle'),
            'user_id' => Auth::user()->id,
        ]);
        $newRectangle->save();
        $newRectangle->addProperty('Width', $request->get('width'));
        $newRectangle->addProperty('Height', $request->get('height'));
        return new ShapeResource($newRectangle);
    }
}
