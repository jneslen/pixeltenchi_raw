<?php

namespace Tenchi\Mapper;

class User extends Mapper
{
	public function find($id)
	{
		if(!is_numeric($id) && !ctype_digit($id))
		{
			$query = $this->_source()->getQuery()
				->from(array('u' => 'users'))
				->where('email = :email', array(':email' => $id));

			$result = $this->_source()->query($this->_resource, $query);

			$record = ($row = \Arr::get($result, 0))
				? $this->_load($row)
				: $this->_load(new \stdClass);

			return $record;
		}
		else
		{
			return parent::find($id);
		}
	}

	protected function _load(\stdClass $data)
	{
		$role = isset($data->role) ? $data->role : 'user';
		$class = explode("\\", get_class($this));
		$class = end($class);

		if(!in_array($role, array('lead', 'client', 'user')))
		{
			$role = 'employee';
		}

		if(strtolower($role) === strtolower($class))
		{
			return parent::_load($data);
		}

		return \Kacela::load($role)->find($this->_primaryKey($this->_primaryKey, $data));
	}
}
