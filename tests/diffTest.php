<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use function genDiff\diff\genDiff;

class DiffTest extends TestCase
{
<<<<<<< HEAD
/**
 * @dataProvider provider
 */
    public function testDiff($expected, $beforeFilePath, $afterFilePath, $format)
=======
    /**
     * @dataProvider provider
     */
    public function testDiff($expected, $beforeFile, $afterFile, $format)
>>>>>>> bec270906d9f8ea7c538338f565fc41ed7051281
    {
        $expected = trim(file_get_contents($expected));
        $this->assertSame($expected, genDiff($beforeFilePath, $afterFilePath, $format));
    }
    public function provider()
    {
        $path = 'tests/fixtures/';
        return [
            'testPrettyJson' => [$path . 'expectedDiffTree', $path . 'beforeTree.json', $path . 'afterTree.json',
            'pretty'],
            'testJaml' => [$path . 'expectedDiff', $path . 'before.yaml', $path . 'after.yaml', 'pretty'],
            'testPlainTree' => [$path . 'expectedTreePlain', $path . 'beforeTree.json', $path . 'afterTree.json',
            'plain'],
            'testJson' => [$path . 'expectedJson', $path . 'before.json', $path . 'after.json', 'json']
            ];
    }
}
