<?php

namespace genDiff\diff;

use function genDiff\parse\parse;
use function genDiff\isbool\isBool;
use function genDiff\pretty\pretty;
use function genDiff\makeDiff\makeDiff;
use function Funct\Collection\union;
use function genDiff\plain\plain;

function diff($firstFile, $secondFile, $format)
{
    $before = parse(file_get_contents($firstFile), $firstFile);
    $after = parse(file_get_contents($secondFile), $secondFile);
    if ($format == 'pretty') {
        $result = pretty(makeDiff($before, $after));
        return "{\n{$result}\n}";
    }
    if ($format == 'plain') {
        return plain(makeDiff($before, $after));
    }
}
