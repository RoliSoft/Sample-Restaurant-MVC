<?
/**
 * Provides Enum support for the language.
 */
abstract class Enum
{

	/**
	 * Array containing the key-value map of all constants of all deriving classes.
	 */
	private static $consts;

	/**
	 * Gets the name of the specified constant value.
	 *
	 * @param int $id Constant value.
	 *
	 * @return string Name of the constant.
	 */
	public static function getName($id)
	{
		$class = get_called_class();

		if (!isset(self::$consts[$class])) {
			self::reflect($class);
		}

		return self::$consts[$class][1][$id];
	}

	/**
	 * Gets the value of the constant by the specified name.
	 *
	 * @param string $name Name of the constant.
	 *
	 * @return int Value of the constant.
	 */
	public static function getValue($name)
	{
		$class = get_called_class();

		if (!isset(self::$consts[$class])) {
			self::reflect($class);
		}

		return self::$consts[$class][0][$name];
	}

	/**
	 * Gets a list of the defined constants in the class.
	 *
	 * @return array Array of constants with their key-value.
	 */
	public static function getConsts()
	{
		$class = get_called_class();

		if (!isset(self::$consts[$class])) {
			self::reflect($class);
		}

		return self::$consts[$class][1];
	}

	/**
	 * Uses reflection to explore the constants in the derived class.
	 *
	 * @param string $class Name of the class to inspect.
	 */
	private static function reflect($class)
	{
		$reflection = new ReflectionClass($class);

		self::$consts[$class][0] = $reflection->getConstants();
		self::$consts[$class][1] = array_flip(self::$consts[$class][0]);
	}

}
