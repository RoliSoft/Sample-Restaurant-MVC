<?
/**
 * Represents a reservation in the database.
 */
class Reserve extends ModelBase
{

	/**
	 * Represents the ID of the reserve in the database.
	 */
	public $id;

	/**
	 * Date of the reservation.
	 */
	public $date;

	/**
	 * ID of the reserving user.
	 */
	public $user_id;

	/**
	 * ID of the reserved menu.
	 */
	public $menu_id;

	/**
	 * Initializes the class.
	 *
	 * @param MVC $app Calling MVC instance.
	 */
	function __construct($app)
	{
		parent::__construct($app);
		parent::setField('date', ['datetime']);
		parent::setField('user_id', ['int', ['foreign_key' => 'User']]);
		parent::setField('menu_id', ['int', ['foreign_key' => 'Menu']]);
	}

}
