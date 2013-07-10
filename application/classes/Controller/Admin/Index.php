<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Index extends Controller_Admin {

	public function before()
	{
		parent::before();

	}

	public function action_index()
	{

	}

	public function disable()
	{
		exit(\Debug::vars($this->request->param('id')));
	}
}