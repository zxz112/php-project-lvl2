<?php

namespace genDiff\plain;

use function genDiff\inbool\inBool;

function toPlain($diff, $parent = '')
{
    $plain = array_reduce($diff, function ($acc, $value) use ($parent) {
        if ($value['type'] == 'deleted') {
            $temp = ltrim("{$parent}.{$value['key']}", ".");
            $acc [] = "Property '{$temp}' was removed";
        }
        if ($value['type'] == 'added') {
            $temp = ltrim("{$parent}.{$value['key']}", ".");
            $acc [] = "Property '{$temp}' was added with value :'" . arrayToStr($value['value']) . "'";
        }
        if ($value['type'] == 'changed') {
            $temp = ltrim("{$parent}.{$value['key']}", ".");
            $acc [] = "Property '{$temp}' was changed. From: '" . arrayToStr($value['oldValue']) . "' to '"
             . arrayToStr($value['newValue']) . "'";
        }
        if ($value['type'] == 'parent') {
            $acc [] = toPlain($value['children'], "{$parent}.{$value['key']}");
        }
        return $acc;
    }, []);
    $result = implode(PHP_EOL, $plain);
    return $result;
}
function arrayToStr($value)
{
    if (is_array($value)) {
        return "complex value";
    }
    return inBool($value);
}
