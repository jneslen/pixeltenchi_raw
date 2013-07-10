<?php

namespace Tenchi\Mapper;

class Lead extends Mapper
{
	public function find_all(\Gacela\Criteria $criteria = null)
	{
		if(is_null($criteria))
		{
			$criteria = \Kacela::criteria();
		}

		$criteria->equals('role', 'lead');

		return parent::find_all($criteria);
	}

	public function get_leads(array $ids)
	{
		$query = $this->_source()->getQuery()
			->from(array('l' => 'leads'), array('l.inquiry_date, l.contact_date, l.business_name, u.*, a.address1, a.address2, a.city, a.state_id, a.province, a.postal, a.country_id, p.number, n.note'))
			->join(array('u' => 'users'), 'u.id = l.id')
			->join(array('a' => 'addresses'), 'a.user_id = l.id AND a.type = "business"', array(), 'left')
			->join(array('p' => 'phones'), 'p.user_id = l.id AND p.type = "primary"', array(), 'left')
			->join(array('n' => 'notes'), 'n.user_id = l.id AND n.type = "inquiry"', array(), 'left')
			->where('u.disabled = 0')
			->in('l.id', $ids)
			->orderby('l.id', 'DESC');

		return $this->_source()->query($this->_resource, $query);
	}

}
