<?php

namespace Tenchi\Model;

class User extends Model {

	static $temp_password_expiration = '+3 days';

	protected $_addresses = array();

	protected $_notes = array();

	protected $_phones = array();

	public function authenticate($values)
	{
		$bonafide = \Bonafide::instance();

		$email = \Arr::get($values, 'email');
		$password = \Arr::get($values, 'password');

		// First try to retrieve a user with this email
		$user = \Kacela::find('user', $email);

		if(!$user->id)
		{
			// No user exists with this email
			return false;
		}

		// Check if a temp password is set and not expired
		if($user->temp_password AND $user->temp_password_date >= time() AND $password == $user->temp_password)
		{
			// Set up to reset password
			$session = \Session::instance();
			$session->set('temp_password_redirect', true);
		}

		$prefix = (substr($user->password, 0, 6) == 'bcrypt')
			? null
			: 'legacy';

		if($bonafide->check($password, $prefix.$user->password))
		{
			// Set up the email and password
			$this->id = $user->id;
			$this->email = $email;
			$this->password = $password;

			// The password was also correct
			return true;
		}

		return false;
	}

	public function end_hijack()
	{
		if($user_id = $this->is_hijacked(true))
		{
			$session = \Session::instance();
			$session->set('user_id', $user_id);
			$session->delete('hijacker_id');
		}
	}

	public function get_login_form()
	{
		$form = \Formo::form('log_in')
			->add('email', array('label' => 'Email'))
			->add('password', 'password', array('label' => 'Password'))
			->rule('email', 'not_empty')
			->rule('password', 'not_empty')
			->rule('log_in', array($this, 'authenticate'), array(':value'))
			->callbacks(array(
			'pass' => array
			(
				':self' => array
				(
					array(array($this, 'login'), array($this))
				),
			),
		));

		return $form;
	}

	public function get_address($type = 'business')
	{
		foreach($this->addresses as $address)
		{
			if($address->type == $type)
			{
				return $address;
			}
		}

		if(isset($this->_addresses[$type]))
		{
			return $this->_addresses[$type];
		}

		$this->_addresses[$type] = new \Tenchi\Model\Address;

		$this->_addresses[$type] ->user_id = $this->id;
		$this->_addresses[$type] ->type = $type;

		return $this->_addresses[$type];
	}

	public function get_form($name = null)
	{
		$form = parent::get_form($name);

		$form->password->set('driver', 'password');
		$form->role->set('driver', 'hidden');


		$form->user_notes->set('driver', 'textarea');

		$form->add('full_name', array('value' => $this->full_name, 'label' => 'Full Name'));

		$form->remove
		(
			array
			(
				'first',
				'last',
				'initial',
				'temp_password_date',
				'last_activity_date',
				'logins',
				'last_login',
				'token',
				'last_ip',
				'password',
				'temp_password',
				'user_notes',
				'registration_date',
				'disabled',
				'email_confirmed'
			)
		);

		return $form;
	}

	public function get_leads_file($leads, $format = 'xls')
	{
		$filename = date('m_d_Y') . '_' . count($leads);

		if ($format == 'xls')
		{
			$data = $this->_build_leads($leads);

			$marks = array();
			foreach($leads as $lead)
			{
				$marks[] = '?';
			}


			return new \Xls($filename, array_shift($data), $data);
		}

		return false;
	}

	public function get_parent_notes()
	{
		return \Kacela::find_active('note', \Kacela::criteria()->isnull('parent_id')->equals('user_id', $this->id)->sort('note_date', 'DESC'));
	}

	public function get_password_form($change = false)
	{
		$form = \Formo::form('password')
			->add('new', 'password', array('label' => 'New password'))
			->rules('new', array(
			array('not_empty'),
			array('min_length', array(':value', 5))
		));

		if ($change === true)
		{
			$form
				->add('confirm', 'password', array('label' => 'Confirm new password'))
				->rules('confirm', array(
				array('matches', array(':validation', 'confirm', 'new'))
			))
				->callbacks(array(
				'pass' => array
				(
					'new' => array
					(
						array(array($this, 'set_password'), array(':value')),
					),
				),
			));
		}

		return $form;
	}

	public function get_note($type = 'inquiry')
	{
		foreach($this->notes as $note)
		{
			if($type == $note->type)
			{
				return $note;
			}
		}

		if(isset($this->_notes[$type]))
		{
			return $this->_notes[$type];
		}

		$this->_notes[$type] = new \Tenchi\Model\Note;

		$this->_notes[$type] ->user_id = $this->id;
		$this->_notes[$type] ->type = $type;

		return $this->_notes[$type];
	}

	public function get_phone($type = 'primary')
	{
		foreach($this->phones as $phone)
		{
			if($type == $phone->type)
			{
				return $phone;
			}
		}

		if(isset($this->_phones[$type]))
		{
			return $this->_phones[$type];
		}

		$this->_phones[$type] = new \Tenchi\Model\Phone;

		$this->_phones[$type] ->user_id = $this->id;
		$this->_phones[$type] ->type = $type;

		return $this->_phones[$type];
	}

	public function get_reset_password_form()
	{
		$form = \Formo::form('reset_password')
			->add('email')
			->rules('email', array(
			array('not_empty'),
			array('email'),
			array('\Valid::email_exists'),
		))
			->callbacks(array(
			'pass' => array
			(
				'email' => array
				(
					array(array($this, 'reset_password'), array(':value'))
				),
			),
		));

		return $form;
	}


	public function is_hijacked($return_id = false)
	{
		$hijacker_id = \Session::instance()->get('hijacker_id');

		return ($return_id === true)
			? $hijacker_id
			: (bool) $hijacker_id;
	}

	public function login()
	{
		\Session::instance()->set('user_id', $this->id);
	}

	public function logout()
	{
		$session = \Session::instance();

		$session->delete('user_id');
		$this->end_hijack();
	}

	public function reset_password($email)
	{
		// Generate a random string
		$temp_password = \Text::random();

		// Save the temp password
		$user = \Kacela::find('user', $email);
		$user->temp_password = $temp_password;
		$user->save();

		// Create the email
		/*TODO: need to set up email system
		$message = \View::factory('email/_template')
			->bind('header', $header)
			->bind('footer', $footer)
			->bind('content', $email_content);

		$header = \View::factory('email/_header')
			->set('title', 'Your Lendio password has been reset');

		$footer = \View::factory('email/_footer');

		$email_content = \View::factory('email/reset_password')
			->bind('email', $email)
			->bind('tmp', $temp_password);

		// Send the email
		$email = \Email::factory('Your Lendio password has been reset')
			->to('benmidget@gmail.com')
			->from('members@lendio.com')
			->message($message->render(), 'text/html')
			->send();
		*/
	}

	public function save($data = null)
	{
		if($this->registration_date == null)
		{
			$this->registration_date = time();
		}

		if($this->temp_password != null AND $this->temp_password_date != null)
		{
			// set the expiration of temp password
			$this->temp_password_date = strtotime(self::$temp_password_expiration);
		}

		if($this->password == null)
		{
			$bonafide = \Bonafide::instance();
			$this->password = $bonafide->hash('temp12123');
		}

		return parent::save($data);
	}

	public function set_password($password)
	{
		$bonafide = \Bonafide::instance();
		$this->password = $bonafide->hash($password);
		$this->save();
	}

	private function _build_leads($leads)
	{
		$schema = \View::factory('admin/leads/lead_schema')->render();
		$xml = \Xml::to_array($schema);

		$csv = array();
		$csv[0] = array();

		foreach ($xml['columns']['columns'] as $column)
		{
			$csv[0][] = $column['column']['header'];
		}

		$i = 0;
		foreach ($leads as $lead)
		{
			$i++;
			$row = array();

			foreach ($xml['columns']['columns'] as $column)
			{
				if (isset($column['column']['field']))
				{
					$row[] = $this->_process_field($column['column']['field'], $lead);
				}
				elseif (isset($column['column']['alias']))
				{
					$row[] = null;
				}
			}

			$csv[] = $row;
			unset($row);
		}

		return $csv;
	}

	protected function _get_full_name()
	{
		return $this->first.' '.$this->last;
	}

	private function _process_field($field, $lead)
	{
		switch ($field)
		{
			case 'business_name':
				return $lead->business_name;
				break;
			case 'fname':
				return $lead->first;
				break;
			case 'lname':
				return $lead->last;
				break;
			case 'address':
				return $lead->address1;
				break;
			case 'city':
				return $lead->city;
				break;
			case 'state':
				return $lead->state_id;
				break;
			case 'province':
				return $lead->province;
				break;
			case 'postal':
				return $lead->postal;
				break;
			case 'country':
				return $lead->country_id;
				break;
			case 'phone':
				return $lead->number;
				break;
			case 'email':
				return $lead->email;
				break;
			case 'inquiry_date':
				return $lead->inquiry_date;
				break;
			case 'contact_date':
				return $lead->contact_date;
				break;
			case 'note':
				return $lead->note;
				break;
		}
	}

	protected function _set_full_name($val)
	{
		$names = explode(' ', $val);

		array_walk($names, 'trim');

		$this->first = current($names);

		$this->last = end($names);
	}

	protected function _set_password($value)
	{
		$bonafide = \Bonafide::instance();

		$this->_set('password', $bonafide->hash($value));

		$this->temp_password = null;
		$this->temp_password_date = null;
	}
}
