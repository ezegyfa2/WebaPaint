<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $shape_type_id
 * @property integer $color_id
 * @property string $created_at
 * @property string $updated_at
 * @property Color $color
 * @property ShapeType $shapeType
 * @property PaintShape[] $paintShapes
 * @property ShapeProperty[] $shapeProperties
 */
class Shape extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['shape_type_id', 'color_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo('App\Models\Color');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shapeType()
    {
        return $this->belongsTo('App\Models\ShapeType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paintShapes()
    {
        return $this->hasMany('App\Models\PaintShape');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shapeProperties()
    {
        return $this->hasMany('App\Models\ShapeProperty');
    }
}
