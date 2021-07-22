<?php

namespace Tests\Feature;

use App\Helpers\LoginTokenGetter;
use App\Helpers\TestHelpers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShapeTest extends TestCase
{
    use TestHelpers, LoginTokenGetter;

    public function testGetShape1()
    {
        $this->assertGet('/api/shapes/1', [
            'width' => '24',
            'height' => '12',
            'type' => 'Rectangle',
            'color' => 'Red'
        ]);
    }

    public function testGetShape2()
    {
        $this->assertGet('/api/shapes/2', [
            'width' => '24',
            'height' => '12',
            'type' => 'Rectangle',
            'color' => 'Red'
        ]);
    }

    public function testGetAnotherUserShape1()
    {
        $this->assertGet('/api/shapes/1', [
            'width' => '24',
            'height' => '12',
            'type' => 'Rectangle',
            'color' => 'Red'
        ]);
    }

    public function testGetAnotherUserShape2()
    {
        $this->assertGet('/api/shapes/2', [
            'width' => '24',
            'height' => '12',
            'type' => 'Rectangle',
            'color' => 'Red'
        ]);
    }
}
