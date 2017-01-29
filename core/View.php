<?php

namespace Core;

use Core\Twig;

class View
{
	/**
	 * Twig instance
	 * @var Core\Twig
	 */
	static protected $twig;

	/**
	 * Render a new View
	 * @param string $view
	 * @param array $params
	 * @return void
	 */
	public static function make(string $view, array $params = [])
	{
		self::$twig = new Twig();
		self::render($view, $params);
	}

	/**
	 * Get a view content
	 * @param  string $view
	 * @param  array  $params
	 * @return void
	 */
	public static function content(string $view, array $params = [])
	{
		self::$twig = new Twig();
		return self::$twig->render($view, $params);
	}

	/**
	 * Render the view using Twig
	 * @param  string $view
	 * @param  array  $params
	 * @return void
	 */
	protected static function render(string $view, array $params = [])
	{
		echo self::$twig->render($view, $params);
	}



}
