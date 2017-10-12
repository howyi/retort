<?php

namespace Howyi;

use Symfony\Component\Yaml\Yaml;

class RetortTest extends \PHPUnit\Framework\TestCase
{
    public function testSeal()
    {
        Retort::seal();
        $this->assertTrue(true);
    }

    public function testHeat()
    {
        $config = [
            'name' => 'Retort',
            'directories' => [
                'src',
                'tests',
            ],
        ];
        file_put_contents('rtrt.yml', Yaml::dump($config, 4, 2));
        Retort::heat();
        unlink('rtrt.yml');
        Retort::heat();
        file_put_contents('rtrt.yml', Yaml::dump($config, 4, 2));
        $this->assertTrue(true);
    }
}
