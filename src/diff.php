<?php

namespace genDiff\diff;

function diff($firstFile, $secondFile)
{
    $before = json_decode(file_get_contents($firstFile));
    $after = json_decode(file_get_contents($secondFile));
    $diff = [];
    foreach ($before as $key1 => $value1) {
        foreach ($after as $key2 => $value2) {
            if ($key1 == $key2 && $value1 == $value2) {
                $diff["  " . $key1] = $value1;
            } elseif ($key1 == $key2 && $value1 != $value2) {
                $diff["+ " . $key1] = $value2;
                $diff["- " . $key1] = $value1;
            } elseif (!array_key_exists($key2, $before)) {
                $diff["- " . $key2] = $value2;
            } elseif (!array_key_exists($key1, $after)) {
                $diff["+ " . $key1] = $value1;
            }
        }
    }
    $result = '';
    foreach ($diff as $key => $value) {
        $result = "{$result}{$key}: {$value}" . PHP_EOL;
    }
    return "{" . PHP_EOL . "{$result}}";
}
