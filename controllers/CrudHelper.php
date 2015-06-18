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

	            switch ($this->app->query['action']) {

		            default:
		            case 'list': {

		                $this->listRecords();

	                } break;

		            case 'manage': {

			            $this->manageRecord($this->app->query['record']);

		            } break;

		            case 'delete': {

			            $this->deleteRecord($this->app->query['record']);

		            } break;

	            }

            } break;

            case POST: {

	            switch ($this->app->query['action']) {

		            case 'manage': {

			            $this->doManageRecord();

		            } break;

		            case 'delete': {

			            $this->doDeleteRecord();

		            } break;

	            }

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

	    $foreign_cols = [];

	    // check if type has foreign keys defined

	    foreach ($this->fields as $field => $type) {
		    if ($type[1]['foreign_key']) {
				$foreign_cols[$field] = $type[1]['foreign_key'];
		    }
	    }

	    $foreigns = [];

	    if (!empty($foreign_cols)) {
		    $foreign_ids = [];

		    // gather all the referenced foreign key IDs

		    foreach ($records as $record) {
				foreach ($foreign_cols as $key => $type) {
					$foreign_ids[$key][(int)$record->$key] = (int)$record->$key;
				}
		    }

		    // fetch all foreign key IDs from database

		    foreach ($foreign_ids as $col => $ids) {
			    $class = $foreign_cols[$col];
			    $instance = new $class($this->app);
			    $foreigns[$col] = $instance->getMany($ids);
		    }
	    }

	    // render the output

	    if (isset($this->headerView)) {
		    $this->app->view->make($this->headerView, $this->headerArgs);
	    }

	    $this->app->view->make('crud/table', ['fields' => $this->fields, 'records' => $records, 'foreigns' => $foreigns]);

	    if (isset($this->footerView)) {
		    $this->app->view->make($this->footerView, $this->footerArgs);
	    }
    }

	/**
	 * Generates the record creation/update form.
	 *
	 * @param int $id Optional ID of the record when editing.
	 *
	 * @throws Exception Failed to fetch item when editing.
	 */
	private function manageRecord($id = null)
	{
		// fetch item, if editing

		if (isset($id)) {
			$table = new $this->type($this->app);
			$record = $table->get($id);

			if (!$record) {
				throw new Exception('Failed to fetch item '.htmlspecialchars($id).' for editing.');
			}
		}

		// check if type has foreign keys defined

		foreach ($this->fields as $field => $type) {
			if ($type[1]['foreign_key']) {
				$foreign_cols[$field] = $type[1]['foreign_key'];
			}
		}

		$foreigns = [];

		if (!empty($foreign_cols)) {
			// fetch all foreign keys from database

			foreach ($foreign_cols as $table => $class) {
				$instance = new $class($this->app);
				$result = $instance->getAll();
				$foreigns[$class] = [];

				foreach ($result as $item) {
					$foreigns[$class][$item->getId()] = (string)$item;
				}

				unset($result);
			}
		}

		// render the output

		if (isset($this->headerView)) {
			$this->app->view->make($this->headerView, $this->headerArgs);
		}

		$this->generateCsrfToken('cru');
		$this->app->view->make('crud/create', ['fields' => $this->fields, 'class' => $this->type, 'foreigns' => $foreigns, 'record' => $record]);

		if (isset($this->footerView)) {
			$this->app->view->make($this->footerView, $this->footerArgs);
		}
	}

	/**
	 * Processes the record creation/update form and executes it.
	 */
	private function doManageRecord()
	{
		if (!$this->verifyCsrfToken('cru')) {
			throw new Exception('Security error: CSRF token validation failed.');
		}

		$table  = new $this->type($this->app);
		$fields = $table->getFields();

		foreach ($fields as $key => $type) {
			if (isset($_POST[$key]) && (strlen($_POST[$key]) != 0 || $type[1]['hidden'])) {
				$table->$key = $_POST[$key];
			}
			else if (!$type[1]['primary_key']) {
				throw new Exception('Field `'.$key.'` is required.');
			}
		}

		if (!$table->save()) {
			throw new Exception('Server error occurred while adding record.');
		}

		// redirect the user

		$this->app->view->redirect('?#item-'.$table->getId());
	}

	/**
	 * Generates the record deletion confirmation.
	 *
	 * @param int $id ID of the record.
	 */
	private function deleteRecord($id)
	{
		$table = new $this->type($this->app);
		$record = $table->get($id);

		if (isset($this->headerView)) {
			$this->app->view->make($this->headerView, $this->headerArgs);
		}

		$this->generateCsrfToken('del');
		$this->app->view->make('crud/delete', ['id' => (int)$id, 'item' => (string)$record, 'class' => $this->type]);

		if (isset($this->footerView)) {
			$this->app->view->make($this->footerView, $this->footerArgs);
		}
	}

	/**
	 * Processes the record deletion form and executes it.
	 */
	private function doDeleteRecord()
	{
		if (!$this->verifyCsrfToken('del')) {
			throw new Exception('Security error: CSRF token validation failed.');
		}

		if ($_POST['delete'] == 'yes') {
			$table = new $this->type($this->app);
			$table->setId($_GET['record']);

			if (!$table->delete()) {
				throw new Exception('Server error occurred while deleting record.');
			}

			$this->app->view->redirect('?');
		}
		else {
			$this->app->view->redirect('?#item-'.(int)$_GET['record']);
		}
	}

	/**
	 * Generates a CSRF token and inserts it into the session variable.
	 *
	 * @param string $name Name of the token.
	 */
	private static function generateCsrfToken($name)
	{
		if (empty($_SESSION[$name.'_csrf'])) {
			$_SESSION[$name.'_csrf'] = self::base64Encode(openssl_random_pseudo_bytes(19));
		}
	}

	/**
	 * Verifies whether the CSRF token is valid.
	 *
	 * @param string $name Name of the token.
	 * @param string $value Value of the token, or $_POST[token] if null.
	 *
	 * @return bool Value indicating whether the sent token is valid.
	 */
	private static function verifyCsrfToken($name, $value = null)
	{
		self::generateCsrfToken($name);

		if (!isset($value)) {
			$value = $_POST['token'];
		}

		return $_SESSION[$name.'_csrf'] == $value;
	}

	/**
	 * Encodes the input to Base64/URL.
	 *
	 * @param string $str String to encode.
	 *
	 * @return string Encoded string.
	 */
	public static function base64Encode($str)
	{
		return rtrim(strtr(base64_encode($str), '+/=', '-_,'), ',');
	}

	/**
	 * Decodes the input from Base64/URL.
	 *
	 * @param string $str String to decode.
	 *
	 * @return string Decoded string.
	 */
	public static function base64Decode($str)
	{
		return base64_decode(strtr($str, '-_,', '+/='));
	}

}
