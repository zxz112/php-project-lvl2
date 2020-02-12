<?php

namespace GenDiff\json;

function json($diff)
{
    return json_encode(array_values($diff));
}
