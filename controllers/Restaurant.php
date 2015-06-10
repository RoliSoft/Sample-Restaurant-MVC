<?
/**
 * Implements the main functions of the restaurant.
 **/
class Restaurant extends ControllerBase
{

	/**
	 * Generates the index page.
	 **/
	public function index()
	{
		$this->app->view->make('header');

		//$this->app->view->make('jumbotron', ['content' => '<h1>Some announcement.</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium, mi sit amet tempus finibus, lorem orci accumsan orci, efficitur commodo felis ipsum id nibh.</p>']);
		$this->app->view->make('freetext', ['content' => '<p>Welcome to the index!</p>']);

		$this->app->view->make('footer');
	}

	/**
	 * Generates today's food choices page.
	 **/
	public function today()
	{
	}

	/**
	 * Generates the weekly menu listing page.
	 **/
	public function week()
	{
	}

	/**
	 * Generates the login page.
	 **/
	public function login()
	{
	}

	/**
	 * Logs the user in, if the info is correct.
	 **/
	public function doLogin()
	{
	}

	/**
	 * Generates the registration page.
	 **/
	public function register()
	{
	}

	/**
	 * Registers the user, if the info is correct.
	 **/
	public function doRegister()
	{
	}

	/**
	 * Generates the reset page.
	 **/
	public function reset()
	{
	}

	/**
	 * Sends the reset link to the user.
	 **/
	public function doReset()
	{
	}

	/**
	 * Logs the user out.
	 **/
	public function doLogout()
	{
	}

	/**
	 * Rates a food on the menu.
	 **/
	public function doRate()
	{
	}

}
