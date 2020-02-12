<?php

namespace genDiff\makeDiff;

use function Funct\Collection\union;

function makeDiff($before, $after)
{
    $ourkeys = union(array_keys($before), array_keys($after));
    $diff = array_map(
        function ($key) use ($before, $after) {
            return valueDiff($key, $before, $after);
        },
        $ourkeys
    );
    return $diff;
}
function valueDiff($key, $before, $after)
{
            
    if (!array_key_exists($key, $before)) {
        return ['type' => 'added', 'key' => $key, 'value' => $after[$key]];
    }
    if (!array_key_exists($key, $after)) {
        return ['type' => 'deleted', 'key' => $key, 'value' => $before[$key]];
    }
    if (is_array($before[$key]) && is_array($after[$key])) {
        return ['type' => 'parent', 'key' => $key, 'value' => $before[$key],
        'children' => makeDiff($before[$key], $after[$key])];
    }
    if ($before[$key] === $after[$key]) {
        return ['type' => 'not changed', 'key' => $key, 'value' => $before[$key]];
    }
    if ($before[$key] !== $after[$key]) {
        return ['type' => 'changed', 'key' => $key, 'oldValue' => $before[$key], 'newValue' => $after[$key]];
    }
}
