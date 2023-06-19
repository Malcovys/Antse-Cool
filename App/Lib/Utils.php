<?php

namespace App\Lib;

class Utils
{
    public static function removeDuplicates($array): array {
        $uniqueArray = array();
        foreach ($array as $element) {
            if (!in_array($element, $uniqueArray)) {
                $uniqueArray[] = $element;
            }
        }
        return $uniqueArray;
    }
}

