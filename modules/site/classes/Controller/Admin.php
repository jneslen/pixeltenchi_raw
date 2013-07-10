<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin extends Controller_Site {

	public $template = 'public';

	protected $_section = 'admin';

	public function before()
	{
		$this->_modal = true;

		parent::before();

		$this->request->scripts(array
		(
			'plugins/jquery-ui-timepicker',
			'plugins/jquery.jstree',
			'plugins/jquery.form',
			'admin'
		));
		$this->request->styles(array
		(
			'jstree'
		));
	}

	public function disable()
	{
		$obj = \Kacela::find($this->request->param('id'), $this->request->param('parentid'));
		$obj->disabled = 1;
		$obj->save();

		exit(json_encode(array('success' => true)));
	}

	protected function _kick_out()
	{
		if ( ! $this->_user instanceof \Tenchi\Model\Employee)
		{
			if ($this->_user->is_hijacked())
			{
				$this->_user->end_hijack();
				$this->_set_user();

				$this->_kick_out();
				return;
			}
			else
			{
				$this->_redirect_after_login();
			}

			$this->_redirect_after_login();
		}

	}
}