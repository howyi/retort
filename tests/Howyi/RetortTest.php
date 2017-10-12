<?php

namespace Howyi;

class RetortTest extends \PHPUnit\Framework\TestCase
{
    public function testHeat()
    {
        Retort::heat();
        $this->assertTrue(true);
    }

    public function testSeal()
    {
        Retort::seal();
        $this->assertTrue(true);
    }
}
