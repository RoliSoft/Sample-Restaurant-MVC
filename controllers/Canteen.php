<?
/**
 * Implements the main functions of the canteen.
 */
class Canteen extends ControllerBase
{

	/**
	 * Generates the index page.
	 */
	public function index()
	{
		$this->app->view->make('header', UserMgmt::getHeaderVariables());

		$this->app->view->make('jumbotron', ['content' => '<h1>Welcome to the canteen site.</h1><p>You can check out the menu for today and the next couple of days, order passes and pay online using your credit card, and reserve your food for the day.</p>']);

		// fetch today's menu

		$menu  = new Menu($this);
		$today = $menu->getAll('date = current_date()');

		// fetch the foods listed on today's menu

		$food_ids = [];
		foreach ($today as $row) {
			$food_ids[$row->food_id] = $row->food_id;
		}

		$food  = new Food($this);
		$foods = $food->getMany($food_ids);

		// render the listing

		$this->app->view->make('todays', ['title' => 'Today\'s Menu', 'subtext' => date('l, jS \of F'), 'foods' => $foods]);

		$this->app->view->make('footer');
	}

	/**
	 * Generates today's food choices page.
	 */
	public function today()
	{
		$this->app->view->make('header', UserMgmt::getHeaderVariables());

		// fetch today's menu

		$menu  = new Menu($this);
		$today = $menu->getAll('date = current_date()');

		// fetch the foods listed on today's menu

		$food_ids = [];
		foreach ($today as $row) {
			$food_ids[$row->food_id] = $row->food_id;
		}

		$food  = new Food($this);
		$foods = $food->getMany($food_ids);

		// render the listing

		$this->app->view->make('todays', ['title' => 'Today\'s Menu', 'subtext' => date('l, jS \of F'), 'foods' => $foods]);

		$this->app->view->make('footer');
	}

	/**
	 * Generates the weekly menu listing page.
	 */
	public function week()
	{
		$this->app->view->make('header', UserMgmt::getHeaderVariables());

		// fetch today's menu

		$menu  = new Menu($this);
		$today = $menu->getAll('yearweek(date) = yearweek(current_date())');

		// fetch the foods listed on today's menu

		$food_ids = [];
		foreach ($today as $row) {
			$food_ids[$row->food_id] = $row->food_id;
		}

		$food  = new Food($this);
		$foods = $food->getMany($food_ids);

		// render the listing

		$this->app->view->make('weeks', ['title' => 'This Week\'s Menu', 'subtext' => date('\W\e\e\k W \of Y'), 'menu' => $today, 'foods' => $foods]);

		$this->app->view->make('footer');
	}

	/**
	 * Generates the passes page.
	 */
	public function passes()
	{
		$this->app->view->make('header', UserMgmt::getHeaderVariables());

		// fetch the passes

		$pass  = new Pass($this);
		$passes = $pass->getAll();

		// initialize the Stripe library

		include 'libs/stripe-php/init.php';

		$stripe = array(
			"secret_key"      => "sk_test_CQlDlxq27p7DzqeVcPZuabwW",
			"publishable_key" => "pk_test_93ozAQlxUqgM01WpFqUdGYbD"
		);

		\Stripe\Stripe::setApiKey($stripe['secret_key']);

		// render the listing

		$this->app->view->make('passes', ['passes' => $passes, 'stripe' => $stripe, 'user' => $_SESSION['user']]);

		$this->app->view->make('footer');
	}

	/**
	 * Processes the pass payment form.
	 */
	public function doPasses()
	{
		// initialize the Stripe library

		include 'libs/stripe-php/init.php';

		$stripe = array(
			"secret_key"      => "sk_test_CQlDlxq27p7DzqeVcPZuabwW",
			"publishable_key" => "pk_test_93ozAQlxUqgM01WpFqUdGYbD"
		);

		\Stripe\Stripe::setApiKey($stripe['secret_key']);

		// do some security checks

		if (empty($token = $_POST['stripeToken'])) {
			throw new Exception('Stripe token not received.');
		}

		if (empty($_SESSION['user'])) {
			throw new Exception('No user is logged in.');
		}

		if (!isset($_POST['pass_id'])) {
			throw new Exception('Pass ID not received.');
		}

		// fetch the pass

		$pass = new Pass($this);
		$pass = $pass->get($_POST['pass_id']);

		// create the charge

		$customer = \Stripe\Customer::create(array(
			'email' => $_SESSION['user']['email'],
			'card'  => $token
		));

		$charge = \Stripe\Charge::create(array(
			'customer' => $customer->id,
			'amount'   => $pass->price * 100,
			'currency' => 'ron'
		));

		if ($charge->status != 'succeeded') {
			throw new Exception('The transaction failed.');
		}

		// save the charge

		$order = new Order($this);

		$order->date    = date('Y-m-d H:i:s');
		$order->user_id = $_SESSION['user']['id'];
		$order->pass_id = $pass->id;
		$order->gateway = Gateways::Stripe;
		$order->txn_id  = $charge->id;
		$order->sum     = $pass->price;

		if (!$order->save()) {
			throw new Exception('Failed to save transaction.');
		}

		// render the output

		$this->app->view->make('header', UserMgmt::getHeaderVariables());

		$this->app->view->make('jumbotron', ['content' => '<h1><i class="fa fa-check breathe-shadow"></i> Purchase Completed</h1><p>You have successfully purchased a '.$pass->name.' Pass for '.$pass->price.' RON.</p>']);

		$this->app->view->make('footer');
	}

	/**
	 * Rates a food on the menu.
	 */
	public function doRate()
	{
	}

	/**
	 * Generates the 404 Not Found page.
	 *
	 * @param string $uri Requested non-existing URI.
	 */
	public function notFound($uri)
	{
		$this->app->view->make('header', UserMgmt::getHeaderVariables());
		$this->app->view->make('jumbotron', [
			'content' => '<h1><i class="fa fa-exclamation-circle breathe-shadow"></i> Page Not Found</h1><p>The requested resource could not be found on the server.</p>'
		]);
		$this->app->view->make('footer');
	}

	/**
	 * Generates the unhandled exception page.
	 *
	 * @param Exception $ex Thrown exception.
	 */
	public function handleException($ex)
	{
		$this->app->view->make('header', UserMgmt::getHeaderVariables());
		$this->app->view->make('jumbotron', [
			'content' => '<h1><i class="fa fa-exclamation-circle breathe-shadow"></i> An Error Occurred</h1><p>The requested resource could not be satisfied at this time due to an unexpected run-time exception.</p><p><pre><big>'.$ex->getMessage().'</big><br /><small>'.$ex->getTraceAsString().'</small></pre></p>'
		]);
		$this->app->view->make('footer');
	}

	/**
	 * Generates the unhandled exception page.
	 *
	 * @param int $errno Level of the error raised.
	 * @param string $errstr Error message.
	 * @param string $errfile Filename that the error was raised in.
	 * @param int $errline Line number the error was raised at.
	 */
	public function handleError($errno, $errstr, $errfile, $errline)
	{
		$this->app->view->make('header', UserMgmt::getHeaderVariables());
		$this->app->view->make('jumbotron', [
			'content' => '<h1><i class="fa fa-exclamation-circle breathe-shadow"></i> An Error Occurred</h1><p>The requested resource could not be satisfied at this time due to an unexpected run-time error.</p><p><pre><big>'.$errstr.'</big><br /><small>'.$errfile.':'.$errline.'</small></pre></p>'
		]);
		$this->app->view->make('footer');
	}

}
