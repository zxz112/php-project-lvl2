<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use function genDiff\diff\diff;

class DiffTest extends TestCase
{
    public function testDiff()
    {
        $after = './after.json';
        $before = './before.json';
        $expected = '{
+ timeout: 50
- timeout: 20
- proxy: 123.234.53.22
+ verbose: 1
  host: hexlet.io
}';

        $this->assertEquals($expected, diff($after, $before));
    }
}