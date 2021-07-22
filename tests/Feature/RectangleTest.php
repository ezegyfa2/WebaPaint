<?php

namespace Tests\Feature;

use App\Helpers\LoginTokenGetter;
use App\Helpers\TestHelpers;
use Tests\TestCase;

class RectangleTest extends TestCase
{
    use TestHelpers, LoginTokenGetter;

    public function testCreateRectangle1()
    {
        $this->assertCreateRectanglePost([
            'color_id' => 2,
            'width' => 1,
            'height' => 2,
        ], [
            'width' => '1',
            'height' => '2',
            'type' => 'Rectangle',
            'color' => 'Blue'
        ], [
            [
                "shape_type_id" => 2,
                "user_id" => 1,
                "color_id" => 2,
            ]
        ]);
    }

    public function testCreateRectangle2()
    {
        $this->assertCreateRectanglePost([
            'color_id' => 2,
            'width' => 12,
            'height' => 23,
        ], [
            'width' => '12',
            'height' => '23',
            'type' => 'Rectangle',
            'color' => 'Blue'
        ], [
            [
                "shape_type_id" => 2,
                "user_id" => 1,
                "color_id" => 2,
            ]
        ]);
    }

    public function testCreateRectangle3()
    {
        $this->assertCreateRectanglePost([
            'color_id' => 3,
            'width' => 1560,
            'height' => 4763,
        ], [
            'width' => '1560',
            'height' => '4763',
            'type' => 'Rectangle',
            'color' => 'Green'
        ], [
            [
                "shape_type_id" => 2,
                "user_id" => 1,
                "color_id" => 3,
            ]
        ]);
    }

    public function testCreateRectangleWithInvalidData1()
    {
        $this->assertRectangleInvalidDataPost([
            'color_id' => 'invalid data',
            'width' => 12,
            'height' => 23,
        ], [
            'color_id' => [
                'The color id must be an integer.'
            ]
        ]);
    }

    public function testCreateRectangleWithInvalidData2()
    {
        $this->assertRectangleInvalidDataPost([
            'color_id' => 2,
            'width' => 'invalid data',
            'height' => 23,
        ], [
            'width' => [
                'The width must be an integer.'
            ]
        ]);
    }

    public function testCreateRectangleWithInvalidData3()
    {
        $this->assertRectangleInvalidDataPost([
            'color_id' => 3,
            'width' => 12,
            'height' => 'invalid data',
        ], [
            'height' => [
                'The height must be an integer.'
            ]
        ]);
    }

    public function testCreateRectangleWithLessData1()
    {
        $this->assertRectangleInvalidDataPost([
            'width' => 12,
            'height' => 23,
        ], [
            'color_id' => [
                'The color id field is required.'
            ]
        ]);
    }

    public function testCreateRectangleWithLessData2()
    {
        $this->assertRectangleInvalidDataPost([
            'color_id' => 2,
            'height' => 23,
        ], [
            'width' => [
                'The width field is required.'
            ]
        ]);
    }

    public function testCreateRectangleWithLessData3()
    {
        $this->assertRectangleInvalidDataPost([
            'color_id' => 3,
            'width' => 12,
        ], [
            'height' => [
                'The height field is required.'
            ]
        ]);
    }

    protected function assertCreateRectanglePost(array $postData, array $expectedResponseData, array $expectedDatabaseData) {
        $this->assertCreatePost('api/shapes/rectangles/create', $postData, $expectedResponseData, 'shapes', $expectedDatabaseData);
    }

    protected function assertRectangleInvalidDataPost(array $postData, array $expectedErrors) {
        $this->assertInvalidDataPost('api/shapes/rectangles/create', $postData, $expectedErrors);
    }
}
