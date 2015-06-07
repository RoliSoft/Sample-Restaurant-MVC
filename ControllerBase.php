<?
/**
 * Represents the base of a controller.
 **/
class ControllerBase
{

	/**
	 * Reference to the parent application.
	 **/
	protected $app;

	/**
	 * Initializes the class.
	 **/
	function __construct($app)
	{
		if (!isset($app)) {
			throw new InvalidArgumentException('The $app argument should point to a valid application.');
		}

		$this->app = $app;
	}

}
