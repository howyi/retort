<?php

namespace Howyi\Compressor;

class Zip implements CompressorInterface
{
    public static function extract(string $path)
    {
        $dirPath = rtrim($path, '.zip');
        $zip = new \ZipArchive();
        $zip->open($path);
        $zip->extractTo($dirPath);
        $zip->close();
    }

    public static function archive(string $path)
    {
        $zipPath = "$path.zip";
        $zip = new \ZipArchive();
        $zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($path) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();
    }
}
