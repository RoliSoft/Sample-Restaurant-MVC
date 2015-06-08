<?
/**
 * Represents the base of a controller.
 **/
class ControllerBase
{

	/**
	 * Reference to the parent application.
	 **/
	public $app;

	/**
	 * Initializes the class.
	 **/
	function __construct($app)
	{
		if (!isset($app) || !is_a($app, 'MVC')) {
			throw new InvalidArgumentException('The $app argument should point to a valid MVC application.');
		}

		$this->app = $app;
	}

}
