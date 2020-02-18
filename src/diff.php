<?php

namespace genDiff\diff;

use function genDiff\parser\parse;
use function genDiff\pretty\toPretty;
use function genDiff\makeDiff\makeDiff;
use function genDiff\plain\toPlain;
use function genDiff\json\toJson;

function genDiff($beforeFilePath, $afterFilePath, $format)
{
    $dataBefore = file_get_contents($beforeFilePath);
    $dataAfter = file_get_contents($afterFilePath);
    $infoFileBefore =  pathinfo($beforeFilePath);
    $formatFileBefore =  $infoFileBefore['extension'];
    $infoFileAfter = pathinfo($afterFilePath);
    $formatFileAfter = $infoFileAfter['extension'];
    $resultBefore = parse($dataBefore, $formatFileBefore);
    $resultAfter = parse($dataAfter, $formatFileAfter);
    $diff = makeDiff($resultBefore, $resultAfter);
    switch ($format) {
        case 'pretty':
            return toPretty($diff);
        case 'plain':
            return toPlain($diff);
        case 'json':
            return toJson($diff);
    }
}
