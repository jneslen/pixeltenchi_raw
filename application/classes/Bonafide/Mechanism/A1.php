<?php defined('SYSPATH') or die('No direct script access.');

class Bonafide_Mechanism_A1 extends Bonafide_Mechanism {

	protected $salt_pattern = '1, 3, 5, 9, 14, 15, 20, 21, 28, 30';
	protected $_salt_array = array();
	protected $_hash_method = 'sha1';

	public function __construct(array $config = NULL)
	{
		parent::__construct($config);

		$this->_salt_array = preg_split('/,\s*/', $this->salt_pattern);
	}

	public function check($password, $hash, $salt = NULL, $iterations = NULL)
	{
		// Legacy auth stores the salt in the hash
		$salt = $this->_find_salt($hash);

		return parent::check($password, $hash, $salt, 1);
	}

	public function hash($password, $salt = NULL, $iterations = NULL)
	{
		if ($salt === NULL)
		{
			// Legacy auth uses FALSE for no salt
			$salt = FALSE;
		}

		// Hash the password, only one iteration supported
		return parent::hash($password, $salt, 1);
	}



	protected function _hash($input, $salt = NULL)
	{
		// Hash the password using legacy auth
		return $this->_hash_password($input, $salt);
	}

	protected function _salt_to_array()
	{
		return preg_split('/,\s*/', $this->salt_pattern);
	}

	protected function _find_salt($password)
	{
		$salt = '';

		foreach ($this->_salt_array as $i => $offset)
		{
			// Find salt characters, take a good long look...
			$salt .= $password[$offset + $i];
		}

		return $salt;
	}

	protected function _a1_hash($str)
	{
		return hash($this->_hash_method, $str);
	}

	protected function _hash_password($password, $salt = FALSE)
	{
		if ( $salt === FALSE)
		{
			// Create a salt seed, same length as the number of offsets in the pattern
			$salt = substr($this->_hash(uniqid(NULL, TRUE)), 0, count($this->salt_pattern));
		}

		// Password hash that the salt will be inserted into
		$hash = $this->_a1_hash($salt.$password);

		// Change salt to an array
		$salt = str_split($salt, 1);

		// Returned password
		$password = '';

		// Used to calculate the length of splits
		$last_offset = 0;

		foreach ($this->_salt_array as $offset)
		{
			// Split a new part of the hash off
			$part = substr($hash, 0, $offset - $last_offset);

			// Cut the current part out of the hash
			$hash = substr($hash, $offset - $last_offset);

			// Add the part to the password, appending the salt character
			$password .= $part.array_shift($salt);

			// Set the last offset to the current offset
			$last_offset = $offset;
		}

		// Return the password, with the remaining hash appended
		return $password.$hash;
	}

}