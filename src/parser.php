<?php

namespace genDiff\parser;

use Symfony\Component\Yaml\Yaml;

function parse($data, $format)
{
    if ($format == 'json') {
        return json_decode($data, true);
    } elseif ($format == 'yaml') {
        return Yaml::parse($data);
    }
}
