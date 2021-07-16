<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertingShapeTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('shape_types')->insert([
            [
                'name' => 'Circle',
            ], [
                'name' => 'Rectangle',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('shape_types')
            ->whereIn('name', [
                'Circle',
                'Rectangle',
            ])->delete();
    }
}
