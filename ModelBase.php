<?
/**
 * Represents the base of a model.
 */
class ModelBase
{

	/**
	 * Reference to the parent application.
	 */
	public $app;

	/**
	 * Class name of the inheriting class.
	 */
	private $class;

	/**
	 * Table name of the inheriting class.
	 */
	private $table;

	/**
	 * Fields of the inheriting class.
	 */
	private $fields;

	/**
	 * Initializes the class.
	 *
	 * @throws Exception The $app argument should point to a valid MVC application.
	 */
	function __construct($app)
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
	}

    /**
     * Gets the item with the specified ID.
     *
     * @param int $id ID of the object to retrieve.
     *
     * @return ModelBase|bool New instance with the object, or false on failure.
     */
	public function get($id)
	{
		$sql = 'select '.join(', ', $this->getFields()).' from '.$this->getTable().' where id = ?';
		$params = [$id];

		$query = $this->app->db->query($sql, $params);

		if (!$query) {
			return false;
		}

		$result = $query->fetch(PDO::FETCH_ASSOC);

		if (!$result) {
			return false;
		}

		$class = $this->getClass();
		$item = new $class($this->app);

		foreach ($result as $key => $value) {
			$item->$key = $value;
		}

		return $item;
	}

    /**
     * Gets all the items, with condition when specified.
     *
     * @param string $where Condition to use in the `where` clause.
     * @param array $params Parameters, if any in the condition specified.
     *
     * @return array|bool Array of instances, or false on failure.
     */
	public function getAll($where = null, $params = null)
	{
		$sql = 'select '.join(', ', $this->getFields()).' from '.$this->getTable();

		if (isset($where)) {
			$sql .= ' where '.$where;
		}

		$query = $this->app->db->query($sql, $params);

		if (!$query) {
			return false;
		}

		$items = [];
		$class = $this->getClass();

		while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
			$item = new $class($this->app);

			foreach ($result as $key => $value) {
				$item->$key = $value;
			}

			$items[] = $item;
		}

		return $items;
	}

	/**
	 * Sends an update of the model values to the database.
     *
     * @return int Value evaluating to true on success, otherwise to false.
	 */
	public function save()
	{
		$fields = $this->getFields();

		if ($fields[0] == 'id') {
			array_shift($fields);
		}

		// if ID is set, perform an update
		if (isset($this->id)) {
			$sql = 'update '.$this->getTable().' set ';
			$params = [];

			foreach ($fields as $field) {
				$sql .= $field.' = ?, ';
				$params[] = $this->$field;
			}

			$sql = rtrim($sql, ', ').' where id = ? limit 1';
			$params[] = $this->id;
		}
		// if ID is not set, perform an insert
		else {
			$sql = 'insert into '.$this->getTable().' ('.join(', ', $fields).') values (';
			$params = [];

			foreach ($fields as $field) {
				$sql .= '?, ';
				$params[] = $this->$field;
			}

			$sql = rtrim($sql, ', ').')';
		}

		$exec = $this->app->db->exec($sql, $params);

		// set the ID of the insert as the ID of this object
		if ($exec && !isset($this->id)) {
			$this->id = (int)$this->app->db->lastInsertId();
		}

		return $exec;
	}

	/**
	 * Creates the table in the database, if doesn't already exist.
     *
     * @return int Value evaluating to true on success, otherwise to false.
	 */
	public function create()
	{
		$sql = 'create table if not exists '.$this->getTable()." (\n";

		$fields = $this->getFields();
		$hasId = false;

		foreach ($fields as $field) {
			if ($field == 'id') {
				$hasId = true;
				$sql .= ' '.$field." int(11) not null auto_increment,\n";
			}
			else if (is_numeric($this->$field)) {
				$sql .= ' '.$field." int(11) not null,\n";
			}
			else {
				$sql .= ' '.$field." text not null,\n";
			}
		}

		if ($hasId) {
			$sql .= " primary key (id)\n";
		}
		else {
			$sql = rtrim($sql, ", \n")."\n";
		}

		$sql .= ') engine=InnoDB default charset=utf8';

		return $this->app->db->exec($sql, $params);
	}

	/**
	 * Gets the class name of the inheriting class.
     *
     * @return string Name of the inheriting class.
	 */
	private function getClass()
	{
		// return cached if available

		if (isset($this->class)) {
			return $this->class;
		}

		// whip out the reflection engine

		return $this->class = get_class($this);
	}

	/**
	 * Gets the table name of the inheriting class.
     *
     * @return string Name of the inheriting class, as a table.
	 */
	private function getTable()
	{
		// return cached if available

		if (isset($this->table)) {
			return $this->table;
		}

		// whip out the reflection engine

		return $this->table = strtolower($this->getClass());
	}

	/**
	 * Gets the fields of the inheriting class.
     *
     * @return array Array of fields in the inheriting class.
	 */
	private function getFields()
	{
		// return cached if available

		if (isset($this->fields)) {
			return $this->fields;
		}

		// whip out the reflection engine

		$reflection = new ReflectionClass($this);
		$properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
		$this->fields = [];

		// filter out the base class and return

		foreach ($properties as $property) {
			if ($property->class != 'ModelBase') {
				$this->fields[] = $property->name;
			}
		}

		return $this->fields;
	}

}
