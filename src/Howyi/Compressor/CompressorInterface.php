<?php

namespace Howyi\Compressor;

interface CompressorInterface
{
    public static function extract(string $path);

    public static function archive(string $path);
}
