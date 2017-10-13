<?php

namespace Howyi;

use Symfony\Component\Yaml\Yaml;

class RetortTest extends \PHPUnit\Framework\TestCase
{
    public function testSealAndHeat()
    {
        self::configYml();
        Retort::heat();
        self::configZip();
        Retort::seal();
        Retort::heat();
        self::configYml();
        Retort::seal();
        self::removeConfig();
        Retort::seal();
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
