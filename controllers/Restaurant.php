<?
/**
 * Implements the main functions of the restaurant.
 **/
class Restaurant extends ControllerBase
{

	/**
	 * Generates the index page.
	 **/
	public function Index()
	{
		print 'Welcome to the index!';

		$food = new Food();
		$food->id = 1;
		$food->name = 'Pizza';
		$food->type = 5;
		$food->get(2);
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
