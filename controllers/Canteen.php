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
