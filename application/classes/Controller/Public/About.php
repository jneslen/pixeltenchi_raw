<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_About extends Controller_Public
{

	public function before()
	{
		parent::before();
		$this->_title = 'PixelTenchi: About';
	}

	public function action_index()
	{
		$this->_content = \View::factory('about')
			->set('lead_form', $this->lead_form(true));
	}
}