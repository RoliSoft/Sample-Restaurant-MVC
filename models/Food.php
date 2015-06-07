<?
/**
 * Represents a food in the database.
 **/
class Food extends ModelBase
{

	/**
	 * Represents the ID of the food in the database.
	 **/
	public $id;

	/**
	 * Name of the food.
	 **/
	public $name;

	/**
	 * Type of the food.
	 **/
	public $type;

	/**
	 * Caloric content of the food.
	 **/
	public $calories;

	/**
	 * User rating of the food.
	 **/
	public $rating;

}

/**
 * Represents a food type.
 **/
abstract class FoodTypes extends SplEnum
{

	/**
	 * Represents soup.
	 **/
    const Soup = 0;

	/**
	 * Represents the main course.
	 **/
    const Main = 1;

	/**
	 * Represents dessert.
	 **/
    const Dessert = 2;

	/**
	 * Represents cold cuts.
	 **/
    const ColdCuts = 3;

	/**
	 * Represents pastry.
	 **/
    const Pastry = 4;

	/**
	 * Represents soda.
	 **/
    const Soda = 5;

	/**
	 * Represents coffee.
	 **/
    const Coffee = 6;

	/**
	* Represents wine.
	**/
	const Wine = 7;

}
