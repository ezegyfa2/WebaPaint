<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $shape_property_type_id
 * @property integer $shape_id
 * @property string $value
 * @property Shape $shape
 * @property ShapePropertyType $shapePropertyType
 */
class ShapeProperty extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'shape_property_type_id',
        'shape_id',
        'value',
    ];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shape()
    {
        return $this->belongsTo('App\Models\Shape');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shapePropertyType()
    {
        return $this->belongsTo('App\Models\ShapePropertyType');
    }
}
