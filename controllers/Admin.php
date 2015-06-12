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
		$this->app->view->make('headerAdmin', UserMgmt::getHeaderVariables());
		//$this->app->view->make('jumbotron', ['content' => '<h1>Some announcement.</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium, mi sit amet tempus finibus, lorem orci accumsan orci, efficitur commodo felis ipsum id nibh.</p>']);
		$this->app->view->make('freetext', ['content' => '<p>Hi admin!</p>']);
		$this->app->view->make('footer');
	}

}
