<?php

namespace GenDiff\json;

function toJson($diff)
{
    return json_encode(array_values($diff));
}
