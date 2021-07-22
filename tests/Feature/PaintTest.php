<?php

namespace Tests\Feature;

use App\Helpers\LoginTokenGetter;
use App\Helpers\TestHelpers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaintTest extends TestCase
{
    use TestHelpers, LoginTokenGetter;

    public function testCreatePaint1()
    {
        $this->assertCreatePaintPost([
            'name' => 'Test paint',
        ], [
            'name' => 'Test paint',
            'shapes' => [],
        ], [
            [
                "name" => 'Test paint',
                "user_id" => 1,
            ]
        ]);
    }

    public function testCreatePaint2()
    {
        $this->assertCreatePaintPost([
            'name' => 'Test paint',
            'shapes' => [
                [
                    'id' => 1,
                    'coordinate_x' => 10,
                    'coordinate_y' => 20,
                ]
            ],
        ], [
            'name' => 'Test paint',
            'shapes' => [
                [
                    "color" => "Red",
                    "type" => "Rectangle",
                    "width" => "24",
                    "height" => "12",
                    "coordinate_x" => 10,
                    "coordinate_y" => 20,
                ]
            ],
        ], [
            [
                'name' => 'Test paint',
                'user_id' => 1,
            ]
        ]);
    }

    protected function assertCreatePaintPost(array $postData, array $expectedResponseData, array $expectedDatabaseData) {
        $this->assertCreatePost('api/paints/create', $postData, $expectedResponseData, 'paints', $expectedDatabaseData);
    }

    protected function assertPaintInvalidDataPost(array $postData, array $expectedErrors) {
        $this->assertInvalidDataPost('api/paints/create', $postData, $expectedErrors);
    }
}
