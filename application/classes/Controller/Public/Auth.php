<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Auth extends Controller_Public {

	public function before()
	{
		parent::before();
		$this->_title = 'Login';
		$this->_titlebar = false;
	}

	public function action_login()
	{
		if(isset($this->_user->id))
		{
			$this->_redirect_after_login();
		}

		$this->_content = View::factory('login')
			->bind('form', $form);

		$user = new \Tenchi\Model\User;
		$form = $user->get_login_form()
			->add('login', 'submit', 'Log in');

		if ($form->load()->validate())
		{
			$this->_set_user();
			$this->_redirect_after_login();
		}
	}

	public function action_logout()
	{
		$this->_user->logout();
		$this->_set_user();

		if($this->_user->id)
		{
			$this->_redirect_after_login();
		}

		$this->redirect('auth/login');
	}

	public function action_reset_password()
	{
		$this->_content = View::factory('public/auth/reset_password')
			->bind('form', $form);

		$user = new \Tenchi\Model\User;
		$form = $user->get_reset_password_form()
			->add('submit', 'submit');

		if ($form->load()->validate())
		{
			echo 'You have been sent a temporary password in your email inbox.';
		}
	}

}
