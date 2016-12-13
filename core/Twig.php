<?php

namespace Core;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_Lexer;

class Twig
{
    /**
     * Twig_Environment instance
     * @var Twig_Environment
     */
    private $instance;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(views_path());

        $this->instance = new \Twig_Environment($loader, [
            'cache' => cache_path('views'),
        ]);
    }

    /**
     * Render the view using a Twig instance.
     * View can be a .php (priority) or .html file.
     * @param  string $view
     * @param  array  $params
     * @return string
     */
    public function render(string $view, array $params) : string
    {
        $view = str_replace('.', DIRECTORY_SEPARATOR, $view);

        if(file_exists(views_path() . $view . '.php'))
            return $this->instance->render($view . '.php', $params);
        else
            return $this->instance->render($view . '.html', $params);
    }
}
