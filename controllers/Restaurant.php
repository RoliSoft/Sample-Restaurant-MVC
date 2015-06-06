<?
/**
 * Implements the main functions of the restaurant.
 **/
class Restaurant// extends AnotherClass
{

	/**
	 * Reference to the parent application.
	 **/
	private $app;

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

	/**
	 * Generates the index page.
	 **/
	public function Index()
	{
	}

	/**
	 * Generates today's food choices page.
	 **/
	public function Today()
	{
	}

	/**
	 * Generates the weekly menu listing page.
	 **/
	public function Week()
	{
	}

	/**
	 * Generates the login page.
	 **/
	public function Login()
	{
	}

	/**
	 * Logs the user in, if the info is correct.
	 **/
	public function DoLogin()
	{
	}

	/**
	 * Generates the registration page.
	 **/
	public function Register()
	{
	}

	/**
	 * Registers the user, if the info is correct.
	 **/
	public function DoRegister()
	{
	}

	/**
	 * Generates the reset page.
	 **/
	public function Reset()
	{
	}

	/**
	 * Sends the reset link to the user.
	 **/
	public function DoReset()
	{
	}

	/**
	 * Logs the user out.
	 **/
	public function DoLogout()
	{
	}

	/**
	 * Rates a food on the menu.
	 **/
	public function DoRate()
	{
	}

}
