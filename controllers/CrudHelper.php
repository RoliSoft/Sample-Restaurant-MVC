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

        $this->app  = $app;
        $this->type = $type;

        $this->headerView = $headerView;
        $this->headerArgs = $headerArgs;
        $this->footerView = $footerView;
        $this->footerArgs = $footerArgs;
    }


    public function make()
    {

    }

}
