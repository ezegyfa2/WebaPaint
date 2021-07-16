<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertingColors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('colors')->insert([
            [
                'name' => 'Red',
            ], [
                'name' => 'Blue',
            ], [
                'name' => 'Green',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('colors')
            ->whereIn('name', [
                'Red',
                'Blue',
                'Green',
            ])->delete();
    }
}
