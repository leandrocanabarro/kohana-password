<?php defined('SYSPATH') or die('No direct script access.');

class Kohana_Password
{

	/**
	 * Instance of the phpass object
	 */
	private $_engine;

	/**
	 * Instance of this password helper
	 */
	private static $_instance = null;

	/**
	 * Load the phpass framework and create its associated object
	 */
	protected function __construct ()
	{
		if (!class_exists('PasswordHash', FALSE))
		{
			require Kohana::find_file('vendor', 'phpass/PasswordHash');
		}

		$this->_engine = new PasswordHash(8, FALSE);
	}

	/**
	 * Get an instance of Password helper
	 *
	 * @return Kohana_Password
	 */
	public static function instance ()
	{
		if (is_null(self::$_instance))
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Check a password with a hash
	 *
	 * @param {string} $hash
	 * @param {string} $password
	 * @return {boolean}
	 */
	public function check ( $hash, $password )
	{
		return $this->_engine->CheckPassword($hash, $password);
	}

	/**
	 * Hash a password
	 *
	 * @param {string} $password
	 * @return {string}
	 */
	public function hash ( $password )
	{
		return $this->_engine->HashPassword($password);
	}

}
