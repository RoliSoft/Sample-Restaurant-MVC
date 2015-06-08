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

		print '<p>Welcome to the index!</p>';

		/*$food = (new Food($this))->getAll('type = ?', [1]);
		print var_dump($food);*/

		/*$food = new Food($this);
		$food->id = 3;
		$food->name = 'French Fries';
		$food->type = FoodTypes::Main;
		$food->calories = 500;
		$food->rate_cnt = 48;
		$food->rate_sum = 216;
		//print var_dump($food->create());
		print var_dump($food->save());
		print var_dump($food);*/

		/*$user = new User($this);
		$user->name = 'RoliSoft';
		$user->setPassword('test');
		$user->email = 'root@rolisoft.net';
		$user->type = UserTypes::Admin;
		print var_dump($user->create());
		print var_dump($user->save());

		$pass = new Pass($this);
		$pass->name = 'Weekly';
		$pass->meals = 5;
		$pass->price = 50;
		print var_dump($pass->create());
		print var_dump($pass->save());

		$menu = new Menu($this);
		$menu->date = date('Y-m-d H:i:s');
		$menu->food_id = 1;
		print var_dump($menu->create());
		print var_dump($menu->save());

		$order = new Order($this);
		$order->date = date('Y-m-d H:i:s');
		$order->user_id = 1;
		$order->pass_id = 1;
		$order->gateway = Gateways::Stripe;
		$order->sum = $pass->price;
		print var_dump($order->create());
		print var_dump($order->save());*/

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
