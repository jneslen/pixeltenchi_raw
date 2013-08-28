<?php

namespace Tenchi\Mapper;

class Campaign extends Mapper
{
	public function find($id)
	{
		$qs = $this->find_active();

		if(!is_numeric($id) && !ctype_digit($id))
		{
			$key = 'campaign_code';
		}
		else
		{
			$key = 'id';
		}

		$model = $qs->search(array($key => $id));

		if($model === false)
		{
			$data = new \stdClass;

			$model = $this->_load($data);
		}

		return $model;
	}
}