<?
/**
 * Represents the base of a controller.
 */
abstract class ControllerBase
{

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

}
