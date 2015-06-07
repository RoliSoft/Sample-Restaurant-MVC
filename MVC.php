<?
define('GET', 'GET');
define('POST', 'POST');

define('DIRECT', 0);
define('PATTERN', 1);

/**
 * Implements MVC functionality.
 **/
class MVC
{

	/**
	 * Contains the route mappings.
	 * Array structure is:
	 *   GET/POST -> DIRECT/PATTERN -> PATH -> HANDLER
	 **/
	protected $routes;


	/**
	 * Path to strip from the request URI before processing.
	 **/
	public $stripPath;


	/**
	 * Initializes the class.
	 **/
	function __construct()
	{
		$this->routes = [GET, POST];
	}

	/**
	 * Sets up a route.
	 **/
	public function route($method, $path, $handler)
	{
		if (!is_array($path)) {
			$this->routes[$method][DIRECT][$path] = $handler;
		}
		else {
			$this->routes[$method][PATTERN][] = [$path, $handler];
		}
	}

	/**
	 * Runs the application.
	 **/
	public function run()
	{
		// try and find a handler for the request

		$method = $_SERVER['REQUEST_METHOD'];
		$path = $_SERVER['REQUEST_URI'];

		if (substr($path, 0, strlen($this->stripPath)) == $this->stripPath) {
			$path = substr($path, strlen($this->stripPath));
		}

		$path = trim($path, '/');

		$handler = $this->getHandler($method, $path);

		// set up the handler and invoke it

		if ($handler === null) {
			throw new Exception('No handler found for the route.');
		}

		$class = $handler[0][0];
		$method = $handler[0][1];
		$arguments = $handler[1];

		if (!class_exists($class)) {
			throw new Exception('Class "'.$class.'" does not exist.');
		}

		$controller = new $class($this);

		if (!method_exists($controller, $method)) {
			throw new Exception('Class "'.$class.'" does not have method "'.$method.'".');
		}

		$controller->$method($arguments);
	}

	/**
	 * Gets the handler callback for the specified method and path.
	 **/
	private function getHandler($method, $path)
	{
		// try to find a direct path first

		if (isset($this->routes[$method][DIRECT][$path])) {
			return [$this->routes[$method][DIRECT][$path]];
		}

		// try to find a path with arguments

		foreach ($this->routes[$method][PATTERN] as $entry) {
			list($components, $handler) = $entry;
			$arguments = [];
			$parsing = $path;

			foreach ($components as $component) {
				// component is a regular expression
				if ($component[0] == ':') {
					if (preg_match('#'.substr($component, 1).'#', $parsing, $match)) {
						$arguments[] = $match[1];
						$parsing = substr($parsing, strlen($match[0]));
					}
					else {
						continue 2;
					}
				}
				// component is a direct string
				else {
					if (substr($parsing, 0, strlen($component)) == $component) {
						$parsing = substr($parsing, strlen($component));
					}
					else {
						continue 2;
					}
				}
			}

			// if components were not a full match, skip
			if (!empty($parsing)) {
				continue;
			}

			return [$handler, $arguments];
		}

		// give up

		return null;
	}

}
