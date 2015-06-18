<?
/**
 * Implements the admin functions of the canteen.
 */
class Admin extends ControllerBase
{

	/**
	 * Magic function that runs whenever a controller is entered.
	 *
	 * @param string $method Method being invoked in controller.
	 * @param array $arguments Arguments being passed to method.
	 *
	 * @return bool Value indicating whether execution should continue.
	 */
	public function enter($method, $arguments)
	{
		if (!UserMgmt::isSignedIn() || !UserMgmt::isAdmin())
		{
			$this->app->view->make('header', UserMgmt::getHeaderVariables());
			$this->app->view->make('jumbotron', [
				'content' => '<h1>Not Enough Privileges</h1><p>You are not logged in as an administrator, but nice try.</p>'
			]);
			$this->app->view->make('footer');

			return false;
		}

		return true;
	}

	/**
	 * Generates the index page.
	 */
	public function index()
	{
		$this->app->view->make('admin/header', UserMgmt::getHeaderVariables());
		$this->app->view->make('freetext', ['content' => '<p>Hi admin!</p>']);
		$this->app->view->make('admin/footer');
	}

	/**
	 * Generates the foods page.
	 */
	public function foods()
	{
		$crud = new CrudHelper($this, 'Food', 'admin/header', UserMgmt::getHeaderVariables(), 'admin/footer', null);
		$crud->run();
	}

	/**
	 * Generates the menu page.
	 */
	public function menu()
	{
		$crud = new CrudHelper($this, 'Menu', 'admin/header', UserMgmt::getHeaderVariables(), 'admin/footer', null);
		$crud->run();
	}

	/**
	 * Generates the passes page.
	 */
	public function passes()
	{
		$crud = new CrudHelper($this, 'Pass', 'admin/header', UserMgmt::getHeaderVariables(), 'admin/footer', null);
		$crud->run();
	}

	/**
	 * Generates the orders page.
	 */
	public function orders()
	{
		$crud = new CrudHelper($this, 'Order', 'admin/header', UserMgmt::getHeaderVariables(), 'admin/footer', null);
		$crud->run();
	}

	/**
	 * Generates the reserves page.
	 */
	public function reserves()
	{
		$crud = new CrudHelper($this, 'Reserve', 'admin/header', UserMgmt::getHeaderVariables(), 'admin/footer', null);
		$crud->run();
	}

	/**
	 * Generates the users page.
	 */
	public function users()
	{
		$crud = new CrudHelper($this, 'User', 'admin/header', UserMgmt::getHeaderVariables(), 'admin/footer', null);
		$crud->run();
	}

}
