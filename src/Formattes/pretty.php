<?php

namespace genDiff\pretty;

use function genDiff\inbool\inBool;

function pretty($pretty)
{
    $result = makePretty($pretty);
    return "{\n{$result}\n}";
}

function makePretty($diff, $space = 0)
{
    $countSpace = str_repeat('    ', $space);
    $result = array_reduce($diff, function ($acc, $value) use ($countSpace, $space) {
        if ($value['type'] == 'deleted') {
            $val = strBuild($value['value'], $space);
            $acc[] = "{$countSpace}  - {$value['key']}: {$val}";
        }
        if ($value['type'] == 'added') {
            $val = strBuild($value['value'], $space);
            $acc[]  = "{$countSpace}  + {$value['key']}: {$val}";
        }
        if ($value['type'] == 'not changed') {
            $val = strBuild($value['value'], $space);
            $acc[] = "{$countSpace}    {$value['key']}: {$val}";
        }
        if ($value['type'] == 'changed') {
            $valOld = strBuild($value['oldValue'], $space);
            $valNew = strBuild($value['newValue'], $space);
            $acc [] = "{$countSpace}  - {$value['key']}: {$valOld}";
            $acc [] = "{$countSpace}  + {$value['key']}: {$valNew}";
        }
        if ($value['type'] == 'parent') {
            $child = makePretty($value['children'], $space + 1);
            $acc [] = "{$countSpace}    {$value['key']}: {" . PHP_EOL . "{$child}\n    {$countSpace}}";
        }
        return $acc;
    }, []);
    return implode(PHP_EOL, $result);
}
function strBuild($value, $space)
{
    $countSpace = str_repeat('    ', $space + 1);
    if (is_array($value)) {
        $keys = array_keys($value);
        $values = array_reduce($keys, function ($acc, $val) use ($value, $countSpace) {
            $acc[] = "{$countSpace}    {$val}: " . inBool($value[$val]);
            return $acc;
        }, []);
        $result = implode(PHP_EOL, $values);
        return "{\n$result\n{$countSpace}}";
    }
    return inBool($value);
}
