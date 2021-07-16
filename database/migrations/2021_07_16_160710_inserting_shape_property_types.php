<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertingShapePropertyTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $circleTypeId = $this->getShapeTypeId('Circle');
        $rectangleId = $this->getShapeTypeId('Rectangle');
        $radiusProperty = [
            'name' => 'Radius',
            'shape_type_id' => $circleTypeId,
        ];
        $widthProperty = [
            'name' => 'Width',
            'shape_type_id' => $rectangleId,
        ];
        $heightProperty = [
            'name' => 'Height',
            'shape_type_id' => $rectangleId,
        ];
        DB::table('shape_property_types')->insert([
            $radiusProperty,
            $widthProperty,
            $heightProperty,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('shape_property_types')
            ->where('name', 'Radius')
            ->where('shape_type_id', $this->getShapeTypeId('Circle'))
            ->delete();
        DB::table('shape_property_types')
            ->whereIn('name', [
                'Width',
                'Height',
            ])->where('shape_type_id', $this->getShapeTypeId('Rectangle'))
            ->delete();
    }

    protected function getShapeTypeId(string $shapeName) {
        return DB::table('shape_types')
            ->where('name', $shapeName)
            ->select('id')
            ->first()->id;
    }
}
