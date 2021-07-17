<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $paint_id
 * @property integer $shape_id
 * @property int $shape_coordinate_x
 * @property int $shape_coordinate_y
 * @property string $created_at
 * @property string $updated_at
 * @property Paint $paint
 * @property Shape $shape
 */
class PaintShape extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'paint_id',
        'shape_id',
        'shape_coordinate_x',
        'shape_coordinate_y',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paint()
    {
        return $this->belongsTo('App\Models\Paint');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shape()
    {
        return $this->belongsTo('App\Models\Shape');
    }
}
