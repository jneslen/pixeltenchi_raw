<?php defined('SYSPATH') or die('No direct script access.');

class Valid extends Kohana_Valid {

	public static function email_exists($email)
	{
		$record = \Kacela::find('user', $email);

		return (bool) $record->id;
	}

	public static function full_name($str)
	{
		// Ignore double spaces
		$str = str_replace('  ', ' ', $str);
		$pass = preg_match('/^[A-Za-z]+ [A-Za-z]/', $str);

		return (bool) $pass;
	}

	public static function unique_email($email, $current_email = null)
	{
		$user = \Kacela::find('user', $email);

		// Passes test if there is not a user->id
		$pass = (bool) $user->id === false;

		if ( ! $pass AND $current_email AND $current_email == $email)
		{
			return true;
		}

		return $pass;
	}

	public static function select_count($vals, $required_num)
	{
		if(count($vals) == $required_num)
		{
			return true;
		}

		return false;
	}

}