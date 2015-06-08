<?
/**
 * Implements a LRU file cache system.
 **/
class Cache
{

	/**
	 * Callback for serialization.
	 **/
	private $encode;

	/**
	 * Callback for deserialization.
	 **/
	private $decode;

	/**
	 * Stores the cache hits/misses in this session for debugging purposes.
	 **/
	private $stats = [];

	/**
	 * Initializes the caching.
	 **/
	function __construct($encode = 'serialize', $decode = 'unserialize')
	{
		if (!function_exists($encode)) {
			throw new InvalidArgumentException('The value in $encode does not contain a callable function name.');
		}

		if (!function_exists($decode)) {
			throw new InvalidArgumentException('The value in $decode does not contain a callable function name.');
		}

		$this->encode = $encode;
		$this->decode = $decode;
	}

	/**
	 * Gets the specified key from the store, if it exists.
	 * When set, the $force parameter will disregard expiration.
	 **/
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
	 **/
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
	 **/
	public function has($key)
	{
		return file_exists('cache/data/'.$key);
	}

	/**
	 * Removes the specified key from the store.
	 **/
	public function del($key)
	{
		$this->stats['delete']['file'][] = $key;

		if (file_exists('cache/data/'.$key)) {
			return @unlink('cache/data/'.$key);
		}

		return true;
	}

}
