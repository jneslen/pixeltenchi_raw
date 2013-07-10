<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Inquire extends Controller_Public {

	public function action_index()
	{
		$this->_content = $this->lead_form(true);
	}

}