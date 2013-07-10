<?php

namespace Tenchi\Model;

class Employee extends User
{

	protected $_session;

	public function __construct($data = array())
	{
		parent::__construct($data);

		$this->_session = \Session::instance();
	}

	public function hijack($user_id)
	{
		$this->_session->set('user_id', $user_id);
		$this->_session->set('hijacker_id', $this->id);
	}

}
