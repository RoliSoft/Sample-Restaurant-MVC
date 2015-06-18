<?
/**
 * Represents the base of a model.
 */
abstract class ModelBase
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
	 * @param MVC $app Calling MVC instance.
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

		$this->reflect();
	}

	/**
	 * Gets the name of the primary key.
	 *
	 * @return string|null Name of the key, or null if none is set as primary.
	 */
	public function getPKName()
	{
		if (isset($this->fields['id']) && $this->fields['id'][1]['primary_key']) {
			return 'id';
		}
		else {
			foreach ($this->fields as $field => $type) {
				if ($type[1]['primary_key']) {
					return $field;
				}
			}
		}

		return null;
	}

	/**
	 * Gets the ID of the item.
	 *
	 * @return int|null ID, or null if none is set as primary.
	 */
	public function getId()
	{
		if (isset($this->fields['id']) && $this->fields['id'][1]['primary_key']) {
			return $this->id;
		}
		else {
			foreach ($this->fields as $field => $type) {
				if ($type[1]['primary_key']) {
					return $this->$field;
				}
			}
		}

		return null;
	}

	/**
     * Gets the item with the specified ID.
     *
     * @param int $id ID of the object to retrieve.
     *
     * @throws Exception There was a query error.
     *
     * @return ModelBase|bool New instance with the object, or false on failure.
     */
	public function get($id)
	{
		$sql = 'select `'.join('`, `', array_keys($this->fields)).'` from `'.$this->table.'` where `'.$this->getPKName().'` = ?';
		$params = [$id];

		$query = $this->app->db->query($sql, $params);

		if (!$query) {
			if ((int)$this->app->db->errorCode()) {
				throw new Exception('Query error: '.join(' / ', $this->app->db->errorInfo()));
			}

			return false;
		}

		$query->setFetchMode(PDO::FETCH_CLASS, $this->class, [$this->app]);
		$result = $query->fetch();

		if (!$result) {
			return false;
		}

		return $result;
	}

	/**
	 * Gets all the items, with the specified IDs.
	 *
	 * @param array $ids Array of IDs to fetch.
	 * @param bool $remap When set to true, resulting array will be remapped so that the keys correspond to the ID.
	 *
	 * @throws Exception There was a query error.
	 *
	 * @return array|bool Array of instances, or false on failure.
	 */
	public function getMany($ids, $remap = true)
	{
		$idcol  = $this->getPKName();
		$result = $this->getAll('`'.$idcol.'` in ('.join(',', $ids).')');

		if (!$result) {
			return false;
		}

		if ($remap) {
			$bucket = [];

			foreach ($result as $record) {
				$bucket[$record->$idcol] = $record;
			}

			unset($result);
			$result = $bucket;
		}

		return $result;
	}

    /**
     * Gets all the items, with condition when specified.
     *
     * @param string $where Condition to use in the `where` clause.
     * @param array $params Parameters, if any in the condition specified.
     *
     * @throws Exception There was a query error.
     *
     * @return array|bool Array of instances, or false on failure.
     */
	public function getAll($where = null, $params = null)
	{
		$sql = 'select `'.join('`, `', array_keys($this->fields)).'` from `'.$this->table.'`';

		if (isset($where)) {
			$sql .= ' where '.$where;
		}

		$query = $this->app->db->query($sql, $params);

		if (!$query) {
			if ((int)$this->app->db->errorCode()) {
				throw new Exception('Query error: '.join(' / ', $this->app->db->errorInfo()));
			}

			return false;
		}

		$query->setFetchMode(PDO::FETCH_CLASS, $this->class, [$this->app]);
		$result = $query->fetchAll();

		if (!$result) {
			return false;
		}

		return $result;
	}

	/**
	 * Sends an update of the model values to the database.
	 *
	 * @throws Exception There was a query error.
     *
     * @return int Value evaluating to true on success, otherwise to false.
	 */
	public function save()
	{
		$idcol  = $this->getPKName();
		$fields = $this->fields;

		if (isset($fields[$idcol])) {
			unset($fields[$idcol]);
		}

		// if ID is set, perform an update
		if (isset($this->id)) {
			$sql = 'update `'.$this->table.'` set ';
			$params = [];

			foreach ($fields as $field => $type) {
				$sql .= '`'.$field.'` = ?, ';
				$params[] = $this->$field;
			}

			$sql = rtrim($sql, ', ').' where `'.$idcol.'` = ? limit 1';
			$params[] = $this->id;
		}
		// if ID is not set, perform an insert
		else {
			$sql = 'insert into `'.$this->table.'` (`'.join('`, `', array_keys($fields)).'`) values (';
			$params = [];

			foreach ($fields as $field => $type) {
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

		if ((int)$this->app->db->errorCode()) {
			throw new Exception('Query error: '.join(' / ', $this->app->db->errorInfo()));
		}

		return $exec;
	}

	/**
	 * Creates the table in the database, if doesn't already exist.
	 *
	 * @throws Exception There was a query error.
     *
     * @return int Value evaluating to true on success, otherwise to false.
	 */
	public function create()
	{
		$sql = 'create table if not exists `'.$this->table."` (\n";

		$hasId = false;

		foreach ($this->fields as $field => $type) {
			$sql .= ' `'.$field.'` ';

			switch ($type[0]) {

				case 'int': {
					if ($type[1]['primary_key']) {
						$sql .= "int(11) not null auto_increment,\n";
						$hasId = $field;
					}
					else {
						$sql .= "int(11) not null,\n";
					}
				} break;

				case 'string': {
					$sql .= "text not null,\n";
				} break;

				case 'date': {
					$sql .= "date not null,\n";
				} break;

				case 'datetime': {
					$sql .= "datetime not null,\n";
				} break;

			}
		}

		if ($hasId) {
			$sql .= ' primary key (`'.$hasId."`)\n";
		}
		else {
			$sql = rtrim($sql, ", \n")."\n";
		}

		$sql .= ') engine=InnoDB default charset=utf8';

		$res = $this->app->db->exec($sql, $params);

		if ((int)$this->app->db->errorCode()) {
			throw new Exception('Query error: '.join(' / ', $this->app->db->errorInfo()));
		}

		return $res;
	}

	/**
	 * Gets the number of records in the database, satisfying a condition when specified.
	 *
	 * @param string $where Condition to use in the `where` clause.
	 * @param array $params Parameters, if any in the condition specified.
	 *
	 * @throws Exception There was a query error.
	 *
	 * @return int|bool Number of records, or false on failure.
	 */
	public function count($where = null, $params = null)
	{
		$sql = 'select count(*) from `'.$this->table.'`';

		if (isset($where)) {
			$sql .= ' where '.$where;
		}

		$query = $this->app->db->query($sql, $params);

		if (!$query) {
			if ((int)$this->app->db->errorCode()) {
				throw new Exception('Query error: '.join(' / ', $this->app->db->errorInfo()));
			}

			return false;
		}

		$query->setFetchMode(PDO::FETCH_ASSOC);
		$result = $query->fetch();

		if (!$result || !isset($result['count(*)'])) {
			return false;
		}

		return (int)$result['count(*)'];
	}

	/**
	 * Gets the rough number of records in the database.
	 *
	 * @throws Exception There was a query error.
	 *
	 * @return int|bool Number of records, or false on failure.
	 */
	public function fastCount()
	{
		$sql = 'select `table_rows` from `information_schema`.`tables` where `table_schema` = database() and `table_name` = ?';
		$params = [$this->table];

		$query = $this->app->db->query($sql, $params);

		if (!$query) {
			if ((int)$this->app->db->errorCode()) {
				throw new Exception('Query error: '.join(' / ', $this->app->db->errorInfo()));
			}

			return false;
		}

		$query->setFetchMode(PDO::FETCH_ASSOC);
		$result = $query->fetch();

		if (!$result || !isset($result['table_rows'])) {
			return false;
		}

		return (int)$result['table_rows'];
	}

	/**
	 * Converts the object into an array.
	 *
	 * @return array Array containing all key-values.
     */
	public function toArray()
	{
		$array = [];

		foreach ($this->fields as $field => $type) {
			$array[$field] = $this->$field;
		}

		return $array;
	}

	/**
	 * Gets the table name and fields of the inheriting class.
	 */
	private function reflect()
	{
		// set class name and derive table name

		$this->class = get_class($this);
		$this->table = strtolower($this->class);

		// whip out the reflection engine

		$reflection = new ReflectionClass($this);
		$properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
		$this->fields = [];

		// filter out the base class and return

		foreach ($properties as $property) {
			if ($property->class != 'ModelBase') {
				if ($property->name == 'id') {
					$this->fields[$property->name] = ['int', ['primary_key' => true]];
				}
				else {
					$this->fields[$property->name] = ['string'];
				}
			}
		}
	}

	/**
	 * Gets the fields and type information for the derived class.
	 *
	 * @return array Array of field name and type information.
     */
	public function getFields()
	{
		return $this->fields;
	}

	/**
	 * Sets the field of the table to a specific type.
	 *
	 * @param string $field Name of the field.
	 * @param array $type Type information for the field.
     */
	public function setField($field, $type)
	{
		$this->fields[$field] = $type;
	}

}
