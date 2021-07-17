<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property ShapePropertyType[] $shapePropertyTypes
 * @property Shape[] $shapes
 */
class ShapeType extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shapePropertyTypes()
    {
        return $this->hasMany('App\Models\ShapePropertyType');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shapes()
    {
        return $this->hasMany('App\Models\Shape');
    }
}
