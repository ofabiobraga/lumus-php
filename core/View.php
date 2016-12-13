<?php

namespace Core;

use Core\Twig;

class View
{
	/**
	 * Render a new View
	 * @param string $view
	 * @param array $params
	 * @return void
	 */
	public static function make(string $view, array $params = [])
	{
		self::render($view, $params);
	}

	/**
	 * Render the view using Twig
	 * @param  string $view
	 * @param  array  $params
	 * @return void
	 */
	protected static function render(string $view, array $params = [])
	{
		$twig = new Twig();
		echo $twig->render($view, $params);
	}

}
