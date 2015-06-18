<?
/**
 * Provides rendering capabilities.
 */
class View
{

	/**
	 * Indicates whether the header was sent up until this point.
	 */
	private $headerSent;

	/**
	 * Indicates whether the footer was sent up until this point.
	 */
	private $footerSent;

	/**
	 * Reference to the parent application.
	 */
	public $app;

	/**
	 * Initializes the class.
	 *
	 * @param MVC $app Calling MVC instance.
	 *
	 * @throws Exception The $app argument should point to a valid MVC application.
	 */
	function __construct($app)
	{
		if (!isset($app) || !is_a($app, 'MVC')) {
			throw new Exception('The $app argument should point to a valid MVC application.');
		}

		$this->app = $app;
	}

	/**
	 * Renders the specified template.
	 *
	 * @param string $path Name of the template.
	 * @param array $vars Variables to expose.
	 *
	 * @throws Exception The $path argument points to a non-existent template.
	 */
	public function make($path, $vars = null)
	{
		$file = 'views/'.$path.'.php';

		if (!file_exists($file)) {
			throw new Exception('The $path argument points to a non-existent template: "'.$path.'".');
		}

		if (strpos($path, 'header') !== false) {
			if (!$this->headerSent) {
				$this->headerSent = true;
			}
			else {
				return;
			}
		}

		if (strpos($path, 'footer') !== false) {
			if (!$this->footerSent) {
				$this->footerSent = true;
			}
			else {
				return;
			}
		}

		if (!empty($vars)) {
			extract($vars);
		}

		include $file;
	}

	/**
	 * Redirects the user to the specified location.
	 *
	 * @param string $url Destination URL.
	 */
	public function redirect($url)
	{
		@header('Location: '.$url);
		$this->make('redirect', ['url' => $url]);
	}

}