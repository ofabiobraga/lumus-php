<?php

namespace Core;

use Philo\Blade\Blade;

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
	 * Render the view using Blade
	 * @param  string $view
	 * @param  array  $params
	 * @return void
	 */
	protected static function render(string $view, array $params = [])
	{
		$blade = new Blade(views_path(), cache_path('views'));
		echo $blade->view()->make($view, $params)->render();
	}
}
