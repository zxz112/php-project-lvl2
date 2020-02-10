<?php

namespace genDiff\parse;

use Symfony\Component\Yaml\Yaml;

function parse($file, $type)
{
    $info = pathinfo($type);
    $format = $info['extension'];
    if ($format == 'json') {
        return json_decode($file, true);
    } elseif ($format == 'yaml') {
        return Yaml::parse($file);
    }
}
