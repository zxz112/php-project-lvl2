<?php

namespace genDiff\diff;

use function genDiff\parse\parse;
use function genDiff\pretty\pretty;
use function genDiff\makeDiff\makeDiff;
use function genDiff\plain\plain;
use function genDiff\json\json;

function diff($firstFile, $secondFile, $format)
{
    $before = parse(file_get_contents($firstFile), $firstFile);
    $after = parse(file_get_contents($secondFile), $secondFile);
    $formats = ['pretty' => pretty(makeDiff($before, $after)),
                'plain' => plain(makeDiff($before, $after)),
                'json' => json(makeDiff($before, $after))];
    return $formats[$format];
}
