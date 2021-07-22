<?php


namespace App\Models;


class AnotherUserShapeException extends \Exception
{
    function __construct(int $shapeId) {
        $this->message = 'Invalid shape id: ' . $shapeId . '. Can\'t use another user shape.';
    }
}
