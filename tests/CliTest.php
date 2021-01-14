<?php

use PHPUnit\Framework\TestCase;

use Clify\Cli;

final class ArrTest extends TestCase
{
    public function testParse()
    {
        $cli = new Cli([
            '-s',
            '--save',
            '-v=value',
            '-d="some data here"',
            '--path="some path"',
            '-w',
            'withoutQuotes',
            '--what',
            'WhatWeAreDoing',
            'lonelyArg',
        ]);

        $this->assertEquals([
            's' => true,
            'save' => true,
            'v' => 'value',
            'd' => 'some data here',
            'path' => 'some path',
            'w' => 'withoutQuotes',
            'what' => 'WhatWeAreDoing',
            'lonelyArg' => true,
        ], $cli->getArgs());
    }

    public function testColorize()
    {
        $this->assertEquals("\e[0;30m\e[43mHello \e[0;31mWorld!", Cli::colorize('{black}{bg:yellow}Hello {red}World!'));
    }
}