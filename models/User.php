<?
/**
 * Represents a user in the database.
 **/
class User extends ModelBase
{

	/**
	 * Represents the ID of the user in the database.
	 **/
	public $id;

	/**
	 * Name of the user.
	 **/
	public $name;

	/**
	 * Password hash of the user.
	 **/
	public $password;

	/**
	 * Email address of the user.
	 **/
	public $email;

	/**
	 * Type of the user.
	 **/
	public $type;

	/**
	 * Sets a new password for the user.
	 **/
	public function setPassword($pass)
	{
		if (strlen($pass) < 4) {
			throw new Exception('Password has to be at least 4 characters.');
		}

		$this->password = substr(password_hash($pass, PASSWORD_BCRYPT, ['cost' => 10]), 7);
	}

	/**
	 * Verifies the specified password.
	 **/
	public function verifyPassword($pass)
	{
		return password_verify($pass, '$2y$10$'.$this->password);
	}

}

/**
 * Represents a user type.
 **/
abstract class UserTypes //extends SplEnum
{

	/**
	 * Represents an administrator.
	 **/
    const Admin = 0;

	/**
	 * Represents an regular user.
	 **/
    const Regular = 1;

}
