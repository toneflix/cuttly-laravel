<?php

namespace ToneflixCode\Cuttly\Exceptions;

class Cuttly_Exception extends Exception 
{
    const SHORTEN = [
        '1' => 304,
        '2' => 400,
        '3' => 405,
        '4' => 401,
        '5' => 422,
        '6' => 405,
    ];
    
    /**
     * Return an error code
     *
     * @param string $type
     * @param string $code
     * @return integer
     */
    public static function getCode(string $type, string $code): int
    {
        if ($type === 'shorten') 
        {
            return self::SHORTEN[$code];
        }

        return 500;
    }
}