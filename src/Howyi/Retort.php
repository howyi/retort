<?php

namespace Howyi;

use Symfony\Component\Yaml\Yaml;

class Retort
{
    public static function heat()
    {
        self::recursive(function (\SplFileInfo $info, string $name) {
            if ($info->isFile() and $info->getFileName() === "$name.zip") {
                $zipPath = $info->getRealPath();
                $dirPath = rtrim($info->getRealPath(), '.zip');
                Zip::extract($zipPath, $dirPath);
            }
        });
    }

    public static function seal()
    {
        self::recursive(function (\SplFileInfo $info, string $name) {
            if ($info->isDir() and $info->getFileName() === $name) {
                $dirPath = $info->getRealPath();
                $zipPath = "$dirPath.zip";
                Zip::archive($dirPath, $zipPath);
            }
        });
    }

    private static function recursive(callable $executer)
    {
        foreach (self::config()['directories'] as $dir) {
            $name = self::config()['name'];
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
                $executer($info, $name);
            }
        }
    }

    private static function config()
    {
        $path = getcwd() . DIRECTORY_SEPARATOR . 'rtrt.yml';
        $contents = file_get_contents($path);
        return Yaml::parse($contents);
    }
}
