<?php
namespace Core\Http;

class Router
{
	/**
	 * Registred routes
	 * @var array
	 */
	protected $routes = array();

	/**
	 * Current HTTP Request URI
	 * @var string
	 */
	protected $request_uri = null;

	/**
	 * Allowed HTTP methods
	 * @var array
	 */
	protected $allowed_methods = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'];

	/**
	 * Route callback storage each route
	 * controller, actions e params
	 * @var array
	 */
	protected $callback = null;

	public function __construct()
	{
		$this->request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$this->execute();
	}

	/**
	 * Add a route with 'GET' Request Method.
	 * @param  $uri
	 * @param  $controller
	 * @param  $action
	 * @return  Router
	 */
	public function get(string $uri, string $callback) : Router
	{
		$this->add('GET', $uri, $callback);
		return $this;
	}

	/**
	 * Add a route with 'POST' Request Method.
	 * @param  $uri
	 * @param  $controller
	 * @param  $action
	 * @return Router
	 */
	public function post(string $uri, string $callback) : Router
	{
		$this->add('POST', $uri, $callback);
		return $this;
	}

	/**
	 * Add a route with 'PUT' Request Method.
	 * @param  $uri
	 * @param  $controller
	 * @param  $action
	 * @return Router
	 */
	public function put(string $uri, string $callback) : Router
	{
		$this->add('PUT', $uri, $callback);
		return $this;
	}

	/**
	 * Add a route with 'DELETE' Request Method.
	 * @param  string $uri
	 * @param  string $controller
	 * @param  string $action
	 * @return Router
	 */
	public function delete(string $uri, string $callback) : Router
	{
		$this->add('DELETE', $uri, $callback);
		return $this;
	}

	/**
	 * Match and execute the request URI
	 * @return bool
	 */
	public function execute() : bool
	{
		// Import routes definitions
		$this->import();

		for($i = 0; $i < sizeof($this->routes); $i++) {

			if(!in_array($this->routes[$i]['method'], $this->allowed_methods))
				continue;

			if($_SERVER['REQUEST_METHOD'] != $this->routes[$i]['method'])
				continue;

			$regex = $this->routes[$i]['regex'];

			if(!preg_match("@^" . $regex . "*$@i", $this->request_uri, $params))
				continue;

			array_shift($params);

			$this->setParams($i, $params);
			$this->callback = $this->routes[$i];
			return $this->dispatch();
		}

		return false;
	}

	/**
	 * Import all routes from routes.php file
	 * @return Router
	 */
	protected function import() : Router
	{
		$route = $this;
		require_once(app_path() . 'routes.php');
		return $this;
	}

	/**
	 * Call controllers and actions
	 * @return bool
	 */
	protected function dispatch() : bool
	{
		$controller = "App\\Controllers\\".$this->callback['controller'];
		$action = $this->callback['action'];
		$params = $this->callback['params'];

		if(!class_exists($controller))
			return false;

		$controller = new $controller;

		if(!method_exists($controller, $action))
			return false;

		call_user_func_array([$controller, $action], $params);

		return true;
	}

	/**
	 * Add a route.
	 * @param  string $method
	 * @param  string $uri
	 * @param  string $controller
	 * @param  $action
	 * @return void
	 */
	protected function add(string $method, string $uri, string $callback)
	{
		$regex = "({[^/]+})";
		$uri_regex = $this->parseRegex($uri);
		$callback = explode('@', $callback);
		$controller = $callback[0];
		$action = $callback[1];

		preg_match_all($regex, $uri, $matches);
		$matches = $this->parseMatches($matches);

		if(sizeof($matches) > 0) {
			foreach($matches as $value) {
				$params = $this->parseMatches($value);
				$regex = str_replace($params, $regex, $uri_regex);
				$params = array_map(function() {}, array_flip($params));
			}

		}

		$this->routes[] = [
            'method' => $method,
            'regex' => $this->parseRegex($regex),
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action,
            'params' => $params
        ];
	}

	/**
	 * Remove brackets from a string
	 * @param string $string
	 * @return string
	 */
	protected function parseRegex(string $string) : string
	{
		$string = str_replace('{', '', $string);
		$string = str_replace('}', '', $string);
		return $string;
	}

	/**
	 * Remove brackets from a string
	 * @param array $array
	 * @return array
	 */
	protected function parseMatches(array $array) : array
	{
		$array = str_replace('{', '', $array);
		$array = str_replace('}', '', $array);
		return $array;
	}

	/**
	 * Get Requested URI
	 * @return string
	 */
	protected function getRequestUri() : string
	{
		return $this->request_uri;
	}

	/**
	 * Set route requested parameters
	 * @param int $index
	 * @param array $params
	 * @return void
	 */
	protected function setParams(int $index, array $params)
	{
		$i = 0;
		foreach($this->routes[$index]['params'] as $key => $value) {
			$this->routes[$index]['params'][$key] = $params[$i];
			$i++;
		}
	}
}
