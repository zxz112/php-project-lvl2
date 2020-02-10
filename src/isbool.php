<?php

namespace genDiff\isbool;

function isBool($value)
{
    if ($value === true) {
        return 'true';
    } elseif ($value === false) {
        return 'false';
    } else {
        return $value;
    }
}
