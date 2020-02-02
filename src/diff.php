<?php
namespace genDiff\diff;

function diff($before1, $after1)
{
    $before = json_decode(file_get_contents($before1));
    $after = json_decode(file_get_contents($after1));

    $result = [];
    foreach($before as $key1 => $value1) {
        foreach ($after as $key2 => $value2) {
            if($key1 == $key2 && $value1 == $value2)
                {
                    $result[$key1] = $value1;
                }
            elseif($key1 == $key2 && $value1 != $value2) {
                $result["+".$key1] = $value2;
                $result["-".$key1] = $value1;
            }
            elseif(!array_key_exists($key2, $before)) {
                $result["+".$key2] = $value2;
            }
            elseif(!array_key_exists($key1, $after)) {
                $result["-".$key1] = $value1;
            }
        }
    }
    foreach($result as $key => $value) {
        echo "$key:$value".PHP_EOL;
    }
}

// print_r(json_encode(diff($before, $after)));