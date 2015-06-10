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

		//$this->app->view->make('jumbotron', ['content' => '<h1>Some announcement.</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque pretium, mi sit amet tempus finibus, lorem orci accumsan orci, efficitur commodo felis ipsum id nibh.</p>']);
		$this->app->view->make('freetext', ['content' => '<p>Welcome to the index!</p>']);

		$this->app->view->make('footer');
	}

	/**
	 * Generates today's food choices page.
	 */
	public function today()
	{
	}

	/**
	 * Generates the weekly menu listing page.
	 */
	public function week()
	{
	}

	/**
	 * Rates a food on the menu.
	 */
	public function doRate()
	{
	}

}
