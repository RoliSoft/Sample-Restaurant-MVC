<?
/**
 * Implements the admin functions of the canteen.
 */
class CrudHelper
{

    /**
     * Reference to the parent application.
     */
    public $app;

    /**
     * Reference to the wrapped model type.
     */
    public $type;

    /**
     * Fields of the wrapped model type.
     */
    public $fields;

    /**
     * Name of the header template to use.
     */
    public $headerView;

    /**
     * Arguments to pass to the header template.
     */
    public $headerArgs;

    /**
     * Name of the footer template to use.
     */
    public $footerView;

    /**
     * Arguments to pass to the footer template.
     */
    public $footerArgs;

    /**
     * Initializes the class.
     *
     * @param MVC $app Calling MVC instance.
     * @param string $type Model class name.
     * @param string $headerView Name of the header template, if any.
     * @param string $headerArgs Arguments to pass to the header template, if any.
     * @param string $footerView Name of the footer template, if any.
     * @param string $footerArgs Arguments to pass to the footer template, if any.
     *
     * @throws Exception The $app argument should point to a valid MVC application,
     *                   and the $type argument to a valid ModelBase-inheriting type.
     */
    function __construct($app, $type, $headerView = null, $headerArgs = null, $footerView = null, $footerArgs = null)
    {
        if (!isset($app)) {
            throw new Exception('The $app argument should point to a valid MVC application.');
        }

        if (is_a($app, 'MVC')) {
            $this->app = $app;
        }
        else {
            if (is_a($app, 'ControllerBase')) {
                $this->app = $app->app;
            }
            else {
                throw new Exception('The $app argument should point to a valid MVC application.');
            }
        }

        if (!isset($type) || !is_a($type, 'ModelBase', true)) {
            throw new Exception('The $type argument should point to a valid ModelBase-inheriting type.');
        }

        $this->type = $type;

        $this->headerView = $headerView;
        $this->headerArgs = $headerArgs;
        $this->footerView = $footerView;
        $this->footerArgs = $footerArgs;

        $instance = new $type($app);
        $this->fields = $instance->getFields();
	    $this->fixFields();
    }

	/**
	 * Fixes the fields array, by populating missing info.
	 */
	private function fixFields()
	{
		foreach ($this->fields as $field => $type) {
			if (!isset($type[1]['name'])) {

				if ($field == 'id') {
					$this->fields[$field][1]['name'] = 'ID';
				}
				else {
					$this->fields[$field][1]['name'] = ucwords(str_replace('_', ' ', $field));

					if (substr($this->fields[$field][1]['name'], -3) === ' Id') {
						$this->fields[$field][1]['name'] = substr($this->fields[$field][1]['name'], 0, strlen($this->fields[$field][1]['name']) - 3);
					}
				}
			}
		}
	}

	/**
	 * Runs the application.
	 */
    public function run()
    {
        switch ($this->app->method) {

            case GET: {

	            $this->listRecords();

            } break;

            case POST: {

            } break;

        }
    }

	/**
	 * Generates a table displaying the records in the database.
	 */
    private function listRecords()
    {
	    $table = new $this->type($this->app);
	    $records = $table->getAll();

	    if (empty($records)) {
		    $records = [];
	    }

	    if (isset($this->headerView)) {
		    $this->app->view->make($this->headerView, $this->headerArgs);
	    }

	    $this->app->view->make('crud/table', ['fields' => $this->fields, 'records' => $records]);

	    if (isset($this->footerView)) {
		    $this->app->view->make($this->footerView, $this->footerArgs);
	    }
    }

}
