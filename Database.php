<?
/**
 * Implements database functionality via extending the PDO class.
 */
class Database extends PDO
{

	/**
	 * Value indicating whether there is an active connection to the database.
	 */
	private $connected = false;

	/**
	 * Stores a history of queries ran in this session for debugging purposes.
	 */
	private $queries = [];

	/**
	 * Initializes the database, but does not connect to it.
	 * First argument can point to a file, a hostname or be a DSN string.
	 *
	 * @param string $file_or_host_or_dsn A file name to load settings from; a hostname pointing to the server;
	 *                                    or a full DSN string containing all the info to create a connection.
	 * @param string $database Name of the table, only when the first argument is a hostname.
	 * @param string $username Username to use while connecting.
	 * @param string $password Password to use while connecting.
	 * @param array $driver_options Additional driver options to pass along to the underlying PDO.
	 *
	 * @throws Exception Unable to derive the required connection info.
	 */
	function __construct($file_or_host_or_dsn, $database = null, $username = null, $password = null, $driver_options = null)
	{
		if (file_exists($file_or_host_or_dsn)) {
			include $file_or_host_or_dsn;
		}
		else {
			if (isset($database)) {
				$hostname = $file_or_host_or_dsn;
			}
			else {
				$dsn = $file_or_host_or_dsn;
			}
		}

		if (isset($dsn)) {
			$this->dsn = $dsn;
		}
		else if (isset($hostname) && isset($database)) {
			$this->dsn = 'mysql:host='.$hostname.';dbname='.$database.';charset=utf8';
		}
		else {
			throw new Exception('Unable to derive the required connection info.');
		}

		$this->username = $username;
		$this->password = $password;
		$this->driver_options = $driver_options;
	}

	/**
	 * Initiates a connection to the database, if there isn't one already.
	 *
	 * @return bool Value indicating whether the connection was successful.
	 */
	protected function connect()
	{
		if (!$this->connected) {
			try {
				@(parent::__construct($this->dsn, $this->username, $this->password, $this->driver_options));
			}
			catch (PDOException $e) {
				// PDOException messages contain the host, user, pass, and as such we do not
				// rethrow and definitely do not show the error message to the user, just return
				// false indicating error.
				//print var_dump($e);
				return false;
			}

			$this->connected = true;
		}

		return true;
	}

	/**
	 * Executes an SQL statement, with optional parameters, returning a result set.
	 *
	 * @param string $sql SQL statement to execute.
	 * @param array $params Parameters, if any in the statement.
	 *
	 * @return PDOStatement|null PDOStatement on success, null/false otherwise.
	 */
	public function query($sql, $params = null)
	{
		if (!$this->connect()) {
			return null;
		}

		$log = ['query' => $sql, 'param' => $params];
		$this->queries[] = &$log;
		$start = microtime(true);

		if (isset($params)) {
			$result = parent::prepare($sql);
			$result->execute($params);
		}
		else {
			$result = parent::query($sql, PDO::FETCH_ASSOC);
		}

		$log['time'] = microtime(true) - $start;
		return $result;
	}

	/**
	 * Executes an SQL statement, with optional parameters, and returns the number of affected rows.
	 *
	 * @param string $sql SQL statement to execute.
	 * @param array $params Parameters, if any in the statement.
	 *
	 * @return int|null Number of rows affected on success, null/false otherwise.
	 */
	public function exec($sql, $params = null)
	{
		if (!$this->connect()) {
			return null;
		}

		$log = ['query' => $sql, 'param' => $params];
		$this->queries[] = &$log;
		$start = microtime(true);

		if (isset($params)) {
			$result = parent::prepare($sql)->execute($params);
		}
		else {
			$result = parent::exec($sql);
		}

		$log['time'] = microtime(true) - $start;
		return $result;
	}

	/**
	 * Quotes a string to be used in a query, even if there is no active connection to the database.
	 *
	 * @param string $var String to be quoted.
	 * @param int $paramtype Provides a data type hint for drivers that have alternate quoting styles.
	 *
	 * @return int|string Number or quoted string.
	 */
	public function quote($var, $paramtype = null)
	{
		if (preg_match('/^\d*$/', $var)) {
			return (int)$var;
		}
		elseif ($this->connected) {
			return parent::quote($var, $paramtype);
		}
		else {
			return '"'.str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $var).'"';
		}
	}

	/**
	 * Returns the number of queries ran in this session.
	 *
	 * @return int Number of queries ran.
	 */
	public function count()
	{
		return count($this->queries);
	}

}
