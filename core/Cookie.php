<?php

namespace Core;

use Core\Translate\TimeString;

class Cookie
{
    /**
     * Get a cookie
     * @param  string $name
     * @return bool
     */
    public static function get(string $name) : bool
    {
        return self::exists($name) ? $_COOKIE[$name] : null;
    }

    /**
     * Set a Cookie
     * @param string  $name
     * @param string  $value
     * @param mixed   $expire
     * @param string  $path
     * @param string  $domain
     * @param boolean $secure
     * @param boolean $http
     * @return void
     */
    public static function set(string $name, string $value, $expire, string $path = '', string $domain = '', bool $secure = false,  bool $http = false)
    {
        if(is_numeric($expire))
            $expire = (int) time() + $expire;
        else
            $expire = TimeString::translate($expire);

        setcookie($name, $value, $expire, $path, $domain, $secure, $http);
    }

    /**
     * Check if a Cookie exists
     * @param  string $name
     * @return bool
     */
    public static function exists(string $name) : bool
    {
        return isset($_COOKIE[$name]);
    }

    /**
     * Delete an existing cookie
     * @param  string $name [description]
     * @return [type]       [description]
     */
    public static function delete(string $name)
    {
        if(self::exists($name))
            self::set($name, '', time() - 3600);
    }
}
