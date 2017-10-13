<?php

namespace Howyi;

use Symfony\Component\Yaml\Yaml;

class Retort
{
    public static function heat()
    {
        self::recursive(function (\SplFileInfo $info, string $name, string $type) {
            $ext = strtolower($type);
            if ($info->isFile() and $info->getFilename() === "$name.$ext") {
                $method = 'Howyi\Compressor\\' . ucfirst($type);
                $method::extract($info->getRealPath());
            }
        });
    }

    public static function seal()
    {
        self::recursive(function (\SplFileInfo $info, string $name, string $type) {
            if ($info->isDir() and $info->getFilename() === $name) {
                $method = 'Howyi\Compressor\\' . ucfirst($type);
                $method::archive($info->getRealPath());
            }
        });
    }

    private static function recursive(callable $executer)
    {
        $type = self::config()['type'];
        $name = self::config()['name'];
        foreach (self::config()['directories'] as $dir) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator(
                    $dir,
                    \FilesystemIterator::CURRENT_AS_FILEINFO |
                    \FilesystemIterator::KEY_AS_PATHNAME |
                    \FilesystemIterator::SKIP_DOTS
                ),
                \RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($files as $path => $info) {
                $executer($info, $name, $type);
            }
        }
    }

    private static function config()
    {
        $path = getcwd() . DIRECTORY_SEPARATOR . 'rtrt.yml';
        if (file_exists($path)) {
            $contents = file_get_contents($path);
            return Yaml::parse($contents);
        } else {
            return [
                'type'        => 'yml',
                'name'        => 'Retort',
                'directories' => [
                    'src',
                    'tests',
                ],
            ];
        }
    }
}
