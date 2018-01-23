<?php

namespace Core\Http;

class Request
{
    /**
     * Current request method
     * @var string
     */
    protected $method;

    /**
     * Request instance
     * @var \Core\Http\Request
     */
    static protected $instance;

    /**
     * Protected constructor for singleton
     */
    protected function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Application instance for singleton
     * @var \Core\Application
     */
    static public function getInstance() : \Core\Http\Request
    {
        if(is_null(self::$instance))
            self::$instance = new Request();

        return self::$instance;
    }

    /**
     * Check if  HTTP Request is POST
     * @return bool
     */
    public function isPost() : bool
    {
        return $this->isMethod('POST');
    }

    /**
     * Check if  HTTP Request is GET
     * @return bool
     */
    public function isGet() : bool
    {
        return $this->isMethod('GET');
    }

    /**
     * Check if  HTTP Request is PUT
     * @return bool
     */
    public function isPut() : bool
    {
        return $this->isMethod('PUT');
    }

    /**
     * Check if  HTTP Request is PATCH
     * @return bool
     */
    public function isPatch() : bool
    {
        return $this->isMethod('PATCH');
    }

    /**
     * Check if  HTTP Request is DELETE
     * @return bool
     */
    public function isDelete() : bool
    {
        return $this->isMethod('DELETE');
    }

    /**
     * Check HTTP Request type
     * @param  string $method
     * @return bool
     */
    public function isMethod(string $method) : bool
    {
        return ($this->method == $method);
    }
}
