<?
/**
 * Implements a LRU file cache system.
 */
class Cache
{

	/**
	 * Callback for serialization.
	 */
	private $encode;

	/**
	 * Callback for deserialization.
	 */
	private $decode;

	/**
	 * Stores the cache hits/misses in this session for debugging purposes.
	 */
	private $stats = [];

	/**
	 * Initializes the caching.
	 *
	 * @param string $encode Function to call to encode.
	 * @param string $decode Function to call to decode.
	 *
	 * @throws Exception The value in $encode/$decode does not contain a callable function name.
	 */
	function __construct($encode = 'serialize', $decode = 'unserialize')
	{
		if (!function_exists($encode)) {
			throw new Exception('The value in $encode does not contain a callable function name.');
		}

		if (!function_exists($decode)) {
			throw new Exception('The value in $decode does not contain a callable function name.');
		}

		$this->encode = $encode;
		$this->decode = $decode;
	}

	/**
	 * Gets the specified key from the store, if it exists.
	 *
	 * @param string $key Key to retrieve from the store.
	 * @param bool $force When set, expiration will be disregarded.
	 *
	 * @return mixed Value of key, or false on failure.
	 */
	public function get($key, $force = false)
	{
		if (!file_exists('cache/data/'.$key))
		{
			$this->stats['miss']['file'][] = $key;
			return false;
		}

		$value = @file_get_contents('cache/data/'.$key);
		$decode = $this->decode;
		$ret = $decode($value);

		if (!$force && $ret[0] < time())
		{
			@unlink('cache/data/'.$key);

			$this->stats['invalid']['file'][] = $key;
			return false;
		}
		else
		{
			@touch('cache/data/'.$key, @filemtime('cache/data/'.$key), time());
		}

		$this->stats['hit']['file'][] = $key;
		return $ret[1];
	}

	/**
	 * Stores the specified key-value with optional TTL into the store.
	 *
	 * @param string $key Key to store value under.
	 * @param mixed $value Value to store under key.
	 * @param int $ttl Time to live in milliseconds.
	 *
	 * @return bool Value indicating success.
	 */
	public function put($key, $value, $ttl = 0)
	{
		$this->stats['store']['file'][] = $key;
		$encode = $this->encode;
		$ret  = @file_put_contents('cache/data/'.$key, $encode([$ttl == 0 ? 2145906000 : time() + $ttl, $value]));

		return $ret;
	}

	/**
	 * Checks whether the specified key is available in the store.
	 * Expiration will not be taken into account due to performance reasons.
	 *
	 * @param string $key Key to check if exists in store.
	 *
	 * @return bool Value indicating whether key exists in store.
	 */
	public function has($key)
	{
		return file_exists('cache/data/'.$key);
	}

	/**
	 * Removes the specified key from the store.
	 *
	 * @param string $key Key to remove from the store.
	 *
	 * @return bool Value indicating whether the key was removed.
	 */
	public function del($key)
	{
		$this->stats['delete']['file'][] = $key;

		if (file_exists('cache/data/'.$key)) {
			return @unlink('cache/data/'.$key);
		}

		return true;
	}

}
