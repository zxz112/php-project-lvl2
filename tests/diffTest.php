<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use function genDiff\diff\diff;

class DiffTest extends TestCase
{
    // public function testJson()
    // {
    //     $after = 'tests/fixtures/after.json';
    //     $before = 'tests/fixtures/before.json';
    //     $this->assertEquals($expected, diff($after, $before, 'pretty'));
    // }
    public function testDiff()
    {
        $before = 'tests/fixtures/before.json';
        $after = 'tests/fixtures/after.json';
        $expected = substr(file_get_contents("tests/fixtures/expectedDiff"), 0, -1);
        $this->assertEquals($expected, diff($before, $after, 'pretty'));
    }
    public function testDiffYaml()
    {
        $before = 'tests/fixtures/before.yaml';
        $after = 'tests/fixtures/after.yaml';
        $expected = substr(file_get_contents("tests/fixtures/expectedDiff"), 0, -1);
        $this->assertEquals($expected, diff($before, $after, 'pretty'));
    }
    public function testTreeDiff()
    {
        $before = 'tests/fixtures/beforeTree.json';
        $after = 'tests/fixtures/afterTree.json';
        $expected = substr(file_get_contents('tests/fixtures/expectedDiffTree'), 0, -1);
        $this->assertEquals($expected, diff($before, $after, 'pretty'));
    }
}