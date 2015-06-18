<?
/**
 * Represents a food in the database.
 */
class Food extends ModelBase
{

	/**
	 * Represents the ID of the food in the database.
	 */
	public $id;

	/**
	 * Name of the food.
	 */
	public $name;

	/**
	 * Type of the food.
	 */
	public $type;

	/**
	 * Caloric content of the food.
	 */
	public $calories;

	/**
	 * Price of the food.
	 **/
	public $price;

	/**
	 * Number of users that have rated the food.
	 */
	public $rate_cnt;

	/**
	 * Sum of the rates submitted by the users.
	 */
	public $rate_sum;

	/**
	 * Initializes the class.
	 *
	 * @param MVC $app Calling MVC instance.
	 */
	function __construct($app)
	{
		parent::__construct($app);
		parent::setField('type', ['int', ['enum' => 'FoodTypes']]);
		parent::setField('calories', ['int', ['suffix' => 'cal']]);
		parent::setField('price', ['int', ['suffix' => 'RON']]);
		parent::setField('rate_cnt', ['int', ['name' => 'Rate Count', 'readonly' => true]]);
		parent::setField('rate_sum', ['int', ['name' => 'Rate Sum', 'readonly' => true]]);
	}

	/**
	 * Adds a rating to the food.
	 *
	 * @param int $score Score of food.
	 */
	public function addRating($score)
	{
		$this->rate_cnt++;
		$this->rate_sum += $score;
	}

	/**
	 * Gets the user rating of the food.
	 *
	 * @return int Score of food.
	 */
	public function getRating()
	{
		return number_format($this->rate_sum / $this->rate_cnt, 2);
	}

	/**
	 * Returns the textual representation of this class.
	 *
	 * @return string Textual representation.
	 */
	public function __toString()
	{
		return $this->name.' ['.FoodTypes::getName($this->type).']';
	}

}

/**
 * Represents a food type.
 */
abstract class FoodTypes extends Enum
{

	/**
	 * Represents soup.
	 */
    const Soup = 0;

	/**
	 * Represents the main course.
	 */
    const Main = 1;

	/**
	 * Represents dessert.
	 */
    const Dessert = 2;

	/**
	 * Represents cold cuts.
	 */
    const ColdCuts = 3;

	/**
	 * Represents pastry.
	 */
    const Pastry = 4;

	/**
	 * Represents soda.
	 */
    const Soda = 5;

	/**
	 * Represents coffee.
	 */
    const Coffee = 6;

	/**
	* Represents wine.
	*/
	const Wine = 7;

}
