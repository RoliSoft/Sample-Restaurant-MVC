<?
/**
 * Represents a pass in the database.
 */
class Pass extends ModelBase
{

	/**
	 * Represents the ID of the pass in the database.
	 */
	public $id;

	/**
	 * Name of the pass.
	 */
	public $name;

	/**
	 * Number of full meals usable for.
	 */
	public $meals;

	/**
	 * Price of the pass.
	 */
	public $price;

	/**
	 * Initializes the class.
	 *
	 * @param MVC $app Calling MVC instance.
	 */
	function __construct($app)
	{
		parent::__construct($app);
		parent::setField('meals', ['int']);
		parent::setField('price', ['int', ['suffix' => 'RON']]);
	}

}
