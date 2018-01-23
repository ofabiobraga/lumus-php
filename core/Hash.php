<?php

namespace Core;

class Hash
{
    /**
     * Create a encrypted hash string
     * @var string
     */
    static public function make(string $string) : string
    {
        return password_hash($string, PASSWORD_BCRYPT);
    }

    /**
     * Verify if string and hash match
     * @var bool
     */
    static public function check(string $string, string $hash) : bool
    {
        return password_verify($string, $hash);
    }
}
