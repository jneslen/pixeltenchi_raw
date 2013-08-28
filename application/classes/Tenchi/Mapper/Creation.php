<?php
namespace Tenchi\Mapper;

class Creation extends Mapper
{
	public function get_types()
	{
		return $this->_fields['type']->values;
	}
}