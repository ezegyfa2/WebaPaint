<?php


namespace App\Helpers;


class ArrayHelpers
{
    static function sortArrayByKeysRecursive(&$arrayToSort): bool {
        foreach ($arrayToSort as &$value) {
            if (is_array($value)) {
                static::sortArrayByKeysRecursive($value);
            }
        }
        return ksort($arrayToSort);
    }
}
