<?php

namespace ToneflixCode\Cuttly\Exceptions;
use Exception;

class CuttlyException extends Exception {
    const SHORTEN = [
        '1' => 304,
        '2' => 400,
        '3' => 405,
        '4' => 401,
        '5' => 422,
        '6' => 405,
    ];

    const EDIT = [
        '2' => 400,
        '3' => 404,
        '4' => 401,
    ];

    /**
     * Return an error code
     *
     * @param string        $type
     * @param string|null   $code
     * @return integer
     */
    public static function setCode(string $type, string $code = null): int
    {
        if ($type === 'shorten')
        {
            return self::SHORTEN[$code];
        }
        elseif ($type === 'edit')
        {
            return self::EDIT[$code];
        }

        return 500;
    }
}
