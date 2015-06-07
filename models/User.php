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
