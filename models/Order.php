<?
/**
 * Represents an order in the database.
 **/
class Order extends ModelBase
{

	/**
	 * Represents the ID of the order in the database.
	 **/
	public $id;

	/**
	 * Date of the order.
	 **/
	public $date;

	/**
	 * ID of the user.
	 **/
	public $userId;

	/**
	 * ID of the pass ordered.
	 **/
	public $passId;

	/**
	 * Payment gateway used.
	 **/
	public $gateway;

	/**
	 * Total price paid.
	 **/
	public $sum;

}

/**
 * Represents a gateway.
 **/
abstract class Gateways //extends SplEnum
{

	/**
	 * Represents Stripe.
	 **/
    const Stripe = 0;

}
