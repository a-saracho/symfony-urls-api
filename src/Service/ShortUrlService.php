<?php

namespace App\Service;

/**
 * Implements all the necessary functions to manage URLs.
 */
class ShortUrlService
{
    public const SHORT_URL_LENGTH = 10;

    /**
     * Generate random string with alphanumeric characters.
     *
     * @return string Shortened Url
     */
    public function shorten_url(): string
    {
        //TODO - Puede hacerse de forma más elegante y efectiva (chequear que no existe en la BBDD)
        $char_str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle($char_str), 0, self::SHORT_URL_LENGTH);
    }

    //TODO - Añadir funciones para comprobaciones (si existe originalUrl, si existe shortUrl)

    //TODO - Añadir funciones para sacar todo el peso posible de UrlController
}
