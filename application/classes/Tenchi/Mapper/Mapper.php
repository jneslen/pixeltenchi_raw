<?php
/**
 * @author Jeff Neslen
 * @date 4/19/12
 * @brief
 *
 */

namespace Tenchi\Mapper;

use Kacela\Mapper as M;

class Mapper extends M\Mapper
{
	public function find_active(\Gacela\Criteria $criteria = null)
	{
		$fields = $this->getFields();

		if(isset($fields['disabled']))
		{
			if(is_null($criteria))
			{
				$criteria = new \Gacela\Criteria;
			}

			$criteria->equals('disabled', 0);
		}

		return parent::find_all($criteria);
	}

	public function find_disabled(\Gacela\Criteria $criteria = null)
	{
		$fields = $this->getFields();

		if(isset($fields['disabled']))
		{
			if(is_null($criteria))
			{
				$criteria = new \Gacela\Criteria;
			}

			$criteria->equals('disabled', 1);
		}

		return parent::find_all($criteria);
	}

	public function find_one(\Gacela\Criteria $criteria = null)
	{
		$rs = $this->find_active($criteria);

		if(count($rs))
		{
			return $rs->current();
		}
		else
		{
			$data = new \stdClass;

			return $this->_load($data);
		}
	}
}
