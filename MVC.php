<?
define('GET', 'GET');
define('POST', 'POST');
define('SPEC', 'SPEC');

define('DIRECT', 0);
define('PATTERN', 1);

define('EXC', 0);
define('ERR', 1);

/**
 * Implements MVC functionality.
 */
class MVC
{

	/**
	 * Contains the route mappings.
	 * Array structure is:
	 *   GET/POST -> DIRECT/PATTERN -> PATH -> HANDLER
	 */
	protected $routes;

	/**
	 * Path to strip from the request URI before processing.
	 */
	public $stripPath;

	/**
	 * Initialized view instance.
	 */
	public $view;

	/**
	 * Initialized database instance.
	 */
	public $db;

	/**
	 * Initialized cache instance.
	 */
	public $cache;

	/**
	 * Request method used for this request, populated by run() before invoking the controller method.
	 */
	public $method;

	/**
	 * Cleaned request path of this request, populated by run() before invoking the controller method.
	 */
	public $path;

	/**
	 * Parsed query string of this request, populated by run() before invoking the controller method.
	 */
	public $query;

	/**
	 * Timestamp of the class construction.
	 */
	public $start;

	/**
	 * Initializes the class.
	 */
	function __construct()
	{
		$this->start  = microtime(true);
		$this->routes = [
			GET  => [ DIRECT => [], PATTERN => [] ],
			POST => [ DIRECT => [], PATTERN => [] ],
			SPEC => []
		];
		$this->view  = new View($this);
		$this->cache = new Cache();

		session_name('sid');
		session_start();
	}

	/**
	 * Sets up a route.
	 *
	 * @param string $method Request method, GET or POST.
	 * @param string $path Request URI.
	 * @param array $handler Callback function.
	 */
	public function route($method, $path, $handler)
	{
		if ($method != SPEC) {
			if (!is_array($path)) {
				$this->routes[$method][DIRECT][$path] = $handler;
			}
			else {
				$this->routes[$method][PATTERN][] = [$path, $handler];
			}
		}
		else {
			$this->routes[$method][$path] = $handler;
		}
	}

	/**
	 * Runs the application.
	 *
	 * @throws Exception No handler found for the route or class/method does not exist.
	 */
	public function run()
	{
		set_error_handler([$this, 'handleError'], E_ALL & ~E_NOTICE);
		set_exception_handler([$this, 'handleException']);

		// try and find a handler for the request

		$method = $_SERVER['REQUEST_METHOD'];
		$path = $_SERVER['REQUEST_URI'];

		if (substr($path, 0, strlen($this->stripPath)) == $this->stripPath) {
			$path = substr($path, strlen($this->stripPath));
		}

		if (($qpos = strpos($path, '?')) !== false) {
			parse_str(substr($path, $qpos + 1), $query);
			$path = substr($path, 0, $qpos);
		}

		$path = trim($path, '/');

		$this->method = $method;
		$this->path   = $path;
		$this->query  = $query;

		$handler = $this->getHandler($method, $path);

		if ($handler === null) {
			header('HTTP/1.0 404 Not Found', true, 404);

			if (isset($this->routes[SPEC][404])) {
				$handler = [$this->routes[SPEC][404], [$path]];
			}
			else {
				throw new Exception('No handler found for the route nor was a 404 handler available.');
			}
		}

		// set up the handler and invoke it

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

		if (method_exists($controller, 'enter')) {
			if (!$controller->enter($method, $arguments)) {
				return;
			}
		}

		$controller->$method($arguments);

		if (method_exists($controller, 'exit')) {
			$controller->exit($method, $arguments);
		}

		restore_exception_handler();
		restore_error_handler();
	}

	/**
	 * Gets the handler callback for the specified method and path.
	 *
	 * @param string $method Request method, GET or POST.
	 * @param string $path Request URI.
	 *
	 * @return array|null Array containing handler callback and arguments, or null on failure.
	 */
	private function getHandler($method, $path)
	{
		// try to find a direct path first

		if (isset($this->routes[$method][DIRECT][$path])) {
			return [$this->routes[$method][DIRECT][$path], []];
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

	/**
	 * Global exception handler.
	 *
	 * @param Exception $ex Thrown exception.
     */
	public function handleException($ex)
	{
		if (isset($this->routes[SPEC][EXC]) && is_callable($this->routes[SPEC][EXC])) {
			list($class, $method) = $this->routes[SPEC][EXC];
			$controller = new $class($this);
			$controller->$method($ex);
		}
		else {
			print 'An exception occurred during the execution of the script, and an exception handler was not available to process it.<br />Error message: '.$ex->getMessage();
		}

		die();
	}

	/**
	 * Global error handler.
	 *
	 * @param int $errno Level of the error raised.
	 * @param string $errstr Error message.
	 * @param string $errfile Filename that the error was raised in.
	 * @param int $errline Line number the error was raised at.
	 */
	public function handleError($errno, $errstr, $errfile, $errline)
	{
		if (isset($this->routes[SPEC][ERR]) && is_callable($this->routes[SPEC][ERR])) {
			list($class, $method) = $this->routes[SPEC][ERR];
			$controller = new $class($this);
			$controller->$method($errno, $errstr, $errfile, $errline);
		}
		else {
			print 'An error occurred during the execution of the script, and an error handler was not available to process it.<br />Error message: '.$errstr;
		}

		die();
	}

}
