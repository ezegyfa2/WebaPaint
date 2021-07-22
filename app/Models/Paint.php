<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property PaintShape[] $paintShapes
 */
class Paint extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paintShapes()
    {
        return $this->hasMany('App\Models\PaintShape');
    }

    public function getShapes()
    {
        return $this->paintShapes->map(function($paintShape) {
            return $paintShape->shape;
        });
    }

    public function addShape(int $shapeId, int $x, int $y) {
        if (Shape::find($shapeId)->user_id == Auth::user()->id) {
            $paintShape = new PaintShape([
                'paint_id' => $this->id,
                'shape_id' => $shapeId,
                'shape_coordinate_x' => $x,
                'shape_coordinate_y' => $y,
            ]);
            $paintShape->save();
        }
        else {
            throw new AnotherUserShapeException($shapeId);
        }
    }
}
