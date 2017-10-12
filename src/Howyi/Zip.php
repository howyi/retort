<?php

namespace Howyi;

class Zip
{
    public static function extract(string $zipPath, string $dirPath)
    {
        $zip = new \ZipArchive();
        $zip->open($zipPath);
        $zip->extractTo($dirPath);
        $zip->close();
    }

    public static function archive(string $dirPath, string $zipPath)
    {
        $zip = new \ZipArchive();
        $zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($dirPath),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file)
        {
            if (!$file->isDir())
            {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($dirPath) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();
    }
}
