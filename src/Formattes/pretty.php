<?php

namespace genDiff\pretty;

use function genDiff\isbool\isBool;

function pretty($diff, $space = 0)
{
    $spaces = str_repeat('    ', $space);
    $result = array_reduce($diff, function ($acc, $value) use ($spaces, $space) {
        if ($value['type'] == 'deleted') {
            $val = strBuild($value['value'], $space);
            $acc[] = "{$spaces}  - {$value['key']}: {$val}";
        }
        if ($value['type'] == 'added') {
            $val = strBuild($value['value'], $space);
            $acc[]  = "{$spaces}  + {$value['key']}: {$val}";
        }
        if ($value['type'] == 'not changed') {
            $val = strBuild($value['value'], $space);
            $acc[] = "{$spaces}    {$value['key']}: {$val}";
        }
        if ($value['type'] == 'changed') {
            $valOld = strBuild($value['oldValue'], $space);
            $valNew = strBuild($value['newValue'], $space);
            $acc [] = "{$spaces}  - {$value['key']}: {$valOld}";
            $acc [] = "{$spaces}  + {$value['key']}: {$valNew}";
        }
        if ($value['type'] == 'parent') {
            $child = pretty($value['children'], $space + 1);
            $acc [] = "{$spaces}    {$value['key']}: {" . PHP_EOL . "{$child}\n    {$spaces}}";
        }
        return $acc;
    }, []);
    return implode(PHP_EOL, $result);
}
function strBuild($value, $space)
{
    $spaces = str_repeat('    ', $space + 1);
    if (is_array($value)) {
        $keys = array_keys($value);
        $values = array_reduce($keys, function ($acc, $val) use ($value, $spaces) {
            $acc[] = "{$spaces}    {$val}: " . isBool($value[$val]);
            return $acc;
        }, []);
        $result = implode(PHP_EOL, $values);
        return "{\n$result\n{$spaces}}";
    }
    return isBool($value);
}
