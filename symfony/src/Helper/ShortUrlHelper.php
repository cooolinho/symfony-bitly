<?php

namespace App\Helper;

class ShortUrlHelper
{
    public static function generate(): string
    {
        $cleanNumber = preg_replace('/\D/', '', microtime(false));

        return strtoupper(base_convert($cleanNumber, 10, 36));
    }
}
