<?php

namespace genDiff\makeDiff;

use function Funct\Collection\union;

function makeDiff($beforeData, $afterData)
{
    $ourkeys = union(array_keys($beforeData), array_keys($afterData));
    $diff = array_map(function ($key) use ($beforeData, $afterData) {
        return valueDiff($key, $beforeData, $afterData);
    }, $ourkeys);
    return $diff;
}
function valueDiff($key, $beforeValue, $afterValue)
{
            
    if (!array_key_exists($key, $beforeValue)) {
        return ['type' => 'added', 'key' => $key, 'value' => $afterValue[$key]];
    }
    if (!array_key_exists($key, $afterValue)) {
        return ['type' => 'deleted', 'key' => $key, 'value' => $beforeValue[$key]];
    }
    if (is_array($beforeValue[$key]) && is_array($afterValue[$key])) {
        return ['type' => 'parent', 'key' => $key, 'value' => $beforeValue[$key],
        'children' => makeDiff($beforeValue[$key], $afterValue[$key])];
    }
    if ($beforeValue[$key] === $afterValue[$key]) {
        return ['type' => 'not changed', 'key' => $key, 'value' => $beforeValue[$key]];
    }
    if ($beforeValue[$key] !== $afterValue[$key]) {
        return ['type' => 'changed', 'key' => $key, 'oldValue' => $beforeValue[$key], 'newValue' => $afterValue[$key]];
    }
}
