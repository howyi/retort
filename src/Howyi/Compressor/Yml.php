<?php

namespace Howyi\Compressor;

use Symfony\Component\Yaml\Yaml as SymfonyYaml;

class Yml implements CompressorInterface
{
    public static function extract(string $path)
    {
        $currentPath = rtrim($path, '.yml');
        $contents = SymfonyYaml::parse(file_get_contents($path));
        foreach ($contents as $filePath => $content) {
            $dirPath = dirname($currentPath . '/' . $filePath);
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0777, true);
            }
            file_put_contents($currentPath . '/' . $filePath, $content);
        }
    }

    public static function archive(string $path)
    {
        $ymlPath = "$path.yml";
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        $contents = [];
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($path) + 1);
                $relativePath = str_replace('\\', '/', $relativePath);
                $contents[$relativePath] = file_get_contents($filePath);
            }
        }

        file_put_contents($ymlPath, SymfonyYaml::dump($contents, 4, 2));
    }
}
