<?php

namespace Core;

class Application
{
    /**
     * Lumus version
     * @var string
     */
    public $version = "0.0.1";

    /**
     * Application instance for singleton
     * @var \Core\Application
     */
    static protected $instance;

    /**
     * Protected constructor for singleton
     */
    protected function __construct() {}

    /**
     * Application instance for singleton
     * @var \Core\Application
     */
    static public function getInstance()
    {
        if(is_null(self::$instance))
            self::$instance = new Application();

        return self::$instance;
    }
}
