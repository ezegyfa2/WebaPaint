<?php

namespace App\Models;

use App\Helpers\ModelHelpers;
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
    use ModelHelpers;

    /**
     * @var array
     */
    protected $fillable = [
        'shape_type_id',
        'color_id',
        'user_id',
    ];

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

    public function addProperty(string $propertyTypeName, string $propertyValue) {
        $propertyType = ShapePropertyType::getByName($propertyTypeName);
        if ($propertyType->shape_type_id == $this->shape_type_id) {
            $newProperty = new ShapeProperty([
                'shape_property_type_id' => $propertyType->id,
                'shape_id' => $this->id,
                'value' => $propertyValue,
            ]);
            $newProperty->save();
        }
        else {
            throw new \Exception('Invalid Property type');
        }
    }
}
