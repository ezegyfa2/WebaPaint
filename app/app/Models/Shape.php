<?php

namespace App;

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
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['shape_type_id', 'color_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function color()
    {
        return $this->belongsTo('App\Color');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shapeType()
    {
        return $this->belongsTo('App\ShapeType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paintShapes()
    {
        return $this->hasMany('App\PaintShape');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shapeProperties()
    {
        return $this->hasMany('App\ShapeProperty');
    }
}
