<?php

namespace App\Models;

use App\Helpers\ModelHelpers;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $shape_type_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property ShapeType $shapeType
 * @property ShapeProperty[] $shapeProperties
 */
class ShapePropertyType extends Model
{
    use ModelHelpers;

    /**
     * @var array
     */
    protected $fillable = [
        'shape_type_id',
        'name'
    ];

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
    public function shapeProperties()
    {
        return $this->hasMany('App\Models\ShapeProperty');
    }
}
