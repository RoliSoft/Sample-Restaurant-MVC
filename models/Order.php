<?
/**
 * Represents an order in the database.
 */
class Order extends ModelBase
{

	/**
	 * Represents the ID of the order in the database.
	 */
	public $id;

	/**
	 * Date of the order.
	 */
	public $date;

	/**
	 * ID of the user.
	 */
	public $user_id;

	/**
	 * ID of the pass ordered.
	 */
	public $pass_id;

	/**
	 * Payment gateway used.
	 */
	public $gateway;

	/**
	 * Total price paid.
	 */
	public $sum;

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
		parent::setField('pass_id', ['int', ['foreign_key' => 'Pass']]);
		parent::setField('gateway', ['int', ['enum' => 'Gateways']]);
		parent::setField('sum', ['int', ['suffix' => 'RON']]);
	}

}

/**
 * Represents a gateway.
 */
abstract class Gateways //extends SplEnum
{

	/**
	 * Represents Stripe.
	 */
    const Stripe = 0;

}
