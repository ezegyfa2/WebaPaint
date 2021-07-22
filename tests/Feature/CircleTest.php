<?php

namespace Tests\Feature;

use App\Helpers\LoginTokenGetter;
use App\Helpers\TestHelpers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertEqualsCanonicalizing;

class CircleTest extends TestCase
{
    use TestHelpers, LoginTokenGetter;

    public function testCreateCircle()
    {
        $this->assertCreateCirclePost([
            'color_id' => 1,
            'radius' => 1,
        ], [
            'color' => 'Red',
            'type' => 'Circle',
            'radius' => '1',
        ], [
            [
                "shape_type_id" => 1,
                "user_id" => 1,
                "color_id" => 1,
            ]
        ]);
    }

    public function testCreateCircle2()
    {
        $this->assertCreateCirclePost([
            'color_id' => 2,
            'radius' => 12,
        ], [
            'color' => 'Blue',
            'type' => 'Circle',
            'radius' => '12',
        ], [
            [
                "shape_type_id" => 1,
                "user_id" => 1,
                "color_id" => 2,
            ]
        ]);
    }

    public function testCreateCircle3()
    {
        $this->assertCreateCirclePost([
            'color_id' => 3,
            'radius' => 1560,
        ], [
            'color' => 'Green',
            'type' => 'Circle',
            'radius' => '1560',
        ], [
            [
                "shape_type_id" => 1,
                "user_id" => 1,
                "color_id" => 3,
            ]
        ]);
    }

    public function testCreateCircleWithInvalidData1()
    {
        $this->assertCircleInvalidDataPost([
            'color_id' => 'invalid data',
            'radius' => 12,
        ], [
            'color_id' => [
                'The color id must be an integer.'
            ]
        ]);
    }

    public function testCreateCircleWithInvalidData2()
    {
        $this->assertCircleInvalidDataPost([
            'color_id' => 2,
            'radius' => 'invalid data',
        ], [
            'radius' => [
                'The radius must be an integer.'
            ]
        ]);
    }

    public function testCreateCircleWithLessData1()
    {
        $this->assertCircleInvalidDataPost([
            'radius' => 12,
        ], [
            'color_id' => [
                'The color id field is required.'
            ]
        ]);
    }

    public function testCreateCircleWithLessData2()
    {
        $this->assertCircleInvalidDataPost([
            'color_id' => 2,
        ], [
            'radius' => [
                'The radius field is required.'
            ]
        ]);
    }

    protected function assertCreateCirclePost(array $postData, array $expectedResponseData, array $expectedDatabaseData) {
        $this->assertCreatePost('api/shapes/circles/create', $postData, $expectedResponseData, 'shapes', $expectedDatabaseData);
    }

    protected function assertCircleInvalidDataPost(array $postData, array $expectedErrors) {
        $this->assertInvalidDataPost('api/shapes/circles/create', $postData, $expectedErrors);
    }
}
