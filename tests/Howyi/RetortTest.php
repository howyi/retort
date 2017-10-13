<?php

namespace Howyi;

use Symfony\Component\Yaml\Yaml;

class RetortTest extends \PHPUnit\Framework\TestCase
{
    public function testSeal()
    {
        self::configZip();
        Retort::seal();
        self::configYml();
        Retort::seal();
        self::removeConfig();
        Retort::seal();
        $this->assertTrue(true);
    }

    public function testHeat()
    {
        self::configZip();
        Retort::heat();
        self::configYml();
        Retort::heat();
        self::removeConfig();
        Retort::heat();
        $this->assertTrue(true);
    }

    public static function configZip()
    {
        self::removeConfig();
        $config = [
            'type'        => 'zip',
            'name'        => 'Retort',
            'directories' => [
                'src',
                'tests',
            ],
        ];
        file_put_contents('rtrt.yml', Yaml::dump($config, 4, 2));
    }

    public static function configYml()
    {
        self::removeConfig();
        $config = [
            'type'        => 'yml',
            'name'        => 'Retort',
            'directories' => [
                'src',
                'tests',
            ],
        ];
        file_put_contents('rtrt.yml', Yaml::dump($config, 4, 2));
    }

    public static function removeConfig()
    {
        if (file_exists('rtrt.yml')) {
            unlink('rtrt.yml');
        }
    }
}
