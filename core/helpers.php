<?php

/**
 * Get application root path.
 * @param  string $path
 * @return string
 */
function root_path(string $path = '') : string
{
	$path = str_replace('/', DIRECTORY_SEPARATOR, $path);
    $path = rtrim($path, DIRECTORY_SEPARATOR);
	return ROOT . $path . DIRECTORY_SEPARATOR;
}

/**
 * Get application app path.
 * @param  string $path
 * @return string
 */
function app_path(string $path = '') : string
{
	return root_path('app/' . $path);
}

/**
 * Get application views path.
 * @param  string $path
 * @return string
 */
function views_path(string $path = '') : string
{
	return app_path('views/' . $path);
}

/**
 * Get application storage path.
 * @param  string $path
 * @return string
 */
function storage_path(string $path = '') : string
{
	return root_path('storage/' . $path);
}

/**
 * Get application cache path.
 * @param  string $path
 * @return string
 */
function cache_path(string $path = '') : string
{
	return storage_path('cache/' . $path);
}

/**
 * Get application logs path.
 * @param  string $path
 * @return string
 */
function logs_path(string $path = '') : string
{
	return root_path('logs/' . $path);
}

/**
 * Get public path
 * @param  string $path
 * @return void
 */
function public_path(string $path = '') : string
{
	return root_path('public/' . $path);
}

/**
 * Get config file content
 * @param  string $config
 * @return void
 */
function config(string $config)
{
	$file = root_path('config/') . $config . '.php';

	if(!file_exists($file))
		throw new Exception("File config '{$config}' does not exists", 1);

	return include($file);
}

/**
 * Get Application class instance
 * @return \Core\Application
 */
function app()
{
	return \Core\Application::getInstance();
}

/**
 * Make a new View
 * @param  string $view
 * @return void
 */
function view(string $view)
{
	return \Core\View::make($view);
}
