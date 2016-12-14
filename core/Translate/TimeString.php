<?php

namespace Core\Translate;

class TimeString
{

    /**
     * Translate a human-friendly time format to
     * a DateTime unix timestamp
     * @param  string $string
     * @return int
     */
    public static function translate(string $string) : int
    {
        $time = \DateTime::createFromFormat('U', time());

        $string = self::parse($string);
        $time->modify($string);

        return $time->getTimestamp();
    }

    /**
     * Parse a human-friendly time format to
     * a DateTime modifier
     * @param  string $string
     * @return string
     */
    protected static function parse(string $string)
    {
        $string_r = explode(' ', $string);

        if(sizeof($string_r) < 2)
            throw new \Exception("Bad formatting for {$string}" , 1);

        $number   = $string_r[0];
        $period   = (substr($string_r[1], -1) != 's') ? $string_r[1].'s' : $string_r[1];
        $modifier = "+{$number} {$period}";

        return $modifier;
    }
}
