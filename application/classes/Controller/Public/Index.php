<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Index extends Controller_Public {

	public function action_index()
	{
		$this->redirect('/portfolio');
	}

}