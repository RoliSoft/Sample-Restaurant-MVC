<?
/**
 * Represents a menu in the database.
 */
class Menu extends ModelBase
{

	/**
	 * Represents the ID of the menu in the database.
	 */
	public $id;

	/**
	 * Date of the menu.
	 */
	public $date;

	/**
	 * ID of the food.
	 */
	public $food_id;

	/**
	 * Initializes the class.
	 *
	 * @param MVC $app Calling MVC instance.
	 */
	function __construct($app)
	{
		parent::__construct($app);
		parent::setField('date', ['date']);
		parent::setField('food_id', ['int', ['foreign_key' => 'Food']]);
	}

}
