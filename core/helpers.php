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
