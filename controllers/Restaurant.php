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
		$this->app->view->make('header');

		print 'Welcome to the index!';

		$food = new Food();
		$food->name = 'Pizza';
		$food->type = FoodTypes::Main;
		$food->calories = 285;
		$food->rate_cnt = 48;
		$food->rate_sum = 216;
		$food->create();
		$food->save();

		$user = new User();
		$user->name = 'RoliSoft';
		$user->setPassword('test');
		$user->email = 'root@rolisoft.net';
		$user->type = UserTypes::Admin;
		$user->create();
		$user->save();

		$pass = new Pass();
		$pass->name = 'Weekly';
		$pass->meals = 5;
		$pass->price = 50;
		$pass->create();
		$pass->save();

		$menu = new Menu();
		$menu->date = date('Y-m-d H:i:s');
		$menu->food_id = 1;
		$menu->create();
		$menu->save();

		$order = new Order();
		$order->date = date('Y-m-d H:i:s');
		$order->user_id = 1;
		$order->pass_id = 1;
		$order->gateway = Gateways::Stripe;
		$order->sum = $pass->price;
		$order->create();
		$order->save();

		$this->app->view->make('footer');
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
