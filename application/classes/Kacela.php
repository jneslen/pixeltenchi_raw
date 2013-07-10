<?php

class Kacela extends Kohana_Kacela
{
	public static function find_active($mapper, Gacela\Criteria $criteria = null)
	{
		return self::load($mapper)->find_active($criteria);
	}

	public static function find_disabled($mapper, Gacela\Criteria $criteria = null)
	{
		return self::load($mapper)->find_disabled($criteria);
	}

	public static function find_one($mapper, Gacela\Criteria $criteria = null)
	{
		return self::load($mapper)->find_one($criteria);
	}
}