<?php

namespace Howyi;

class RetortTest extends \PHPUnit\Framework\TestCase
{
    public function testSeal()
    {
        Retort::seal();
        $this->assertTrue(true);
    }

    public function testHeat()
    {
        Retort::heat();
        $this->assertTrue(true);
    }
}
