<?
/**
 * Represents a user in the database.
 */
class User extends ModelBase
{

	/**
	 * Represents the ID of the user in the database.
	 */
	public $id;

	/**
	 * Name of the user.
	 */
	public $name;

	/**
	 * Password hash of the user.
	 */
	public $password;

	/**
	 * Email address of the user.
	 */
	public $email;

	/**
	 * Type of the user.
	 */
	public $type;

	/**
	 * Initializes the class.
	 *
	 * @param MVC $app Calling MVC instance.
	 */
	function __construct($app)
	{
		parent::__construct($app);
		parent::setField('type', ['int', ['enum' => 'UserTypes']]);
		parent::setField('password', ['string', ['hidden' => true]]);
	}

	/**
	 * Sets a new password for the user.
	 *
	 * @param string $pass Unencrypted password to set.
	 *
	 * @throws Exception Password has to be at least 4 characters.
	 */
	public function setPassword($pass)
	{
		if (strlen($pass) < 4) {
			throw new Exception('Password has to be at least 4 characters.');
		}

		$this->password = substr(password_hash($pass, PASSWORD_BCRYPT, ['cost' => 10]), 7);
	}

	/**
	 * Verifies the specified password.
	 *
	 * @param string $pass Unencrypted password to verify.
	 *
	 * @return bool Value indicating whether the passwords match.
	 */
	public function verifyPassword($pass)
	{
		return password_verify($pass, '$2y$10$'.$this->password);
	}

}

/**
 * Represents a user type.
 */
abstract class UserTypes extends Enum
{

	/**
	 * Represents an administrator.
	 */
    const Admin = 0;

	/**
	 * Represents an regular user.
	 */
    const Regular = 1;

}
