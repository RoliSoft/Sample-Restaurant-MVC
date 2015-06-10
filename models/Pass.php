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

}
