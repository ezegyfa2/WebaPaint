<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaintShapeResource;
use App\Models\AnotherUserShapeException;
use App\Models\Paint;
use App\Http\Resources\PaintResource;
use App\Http\Requests\PaintRequest;
use App\Models\PaintShape;
use Illuminate\Support\Facades\Auth;

class PaintController extends Controller
{
    public function index() {
        return Paint::getCurrentUserItemIds();
    }

    public function create(PaintRequest $request)
    {
        $paint = new Paint([
            'name' => $request->get('name'),
            'user_id' => Auth::user()->id,
        ]);
        $paint->save();
        if ($request->has('shapes')) {
            foreach ($request->get('shapes') as $shape) {
                try {
                    $paint->addShape(
                        $shape['id'],
                        $shape['coordinate_x'],
                        $shape['coordinate_y']
                    );
                } catch (AnotherUserShapeException $e) {
                    return response($e->getMessage(), 422);
                }
            }
        }
        return new PaintResource($paint);
    }
}
