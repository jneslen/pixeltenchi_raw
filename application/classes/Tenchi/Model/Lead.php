<?php

namespace Tenchi\Model;

class Lead extends User
{
	public function create_new_lead($form)
	{
		//if this is an existing email then just update that leads info else create a new lead
		if(!\Valid::unique_email($form->email->val()))
		{
			$lead = \Kacela::find('user', $form->email->val());
		}
		else
		{
			$lead = $this;
			// Generate the temp password
			$temp_password = \Text::random();
			$hash_password = \Bonafide::instance()->hash($temp_password);
			$lead->password = $hash_password;
			$lead->inquiry_ip = \Request::$client_ip;
		}

		// Set the user variables
		$lead->full_name = $form->name->val();
		$lead->email = $form->email->val();
		$lead->campaign_id = $form->campaign_id->val();
		$lead->role = 'lead';
		$lead->inquiry_date = time();
		$lead->last_activity_date = time();
		$lead->last_ip = \Request::$client_ip;

		// Insert the user and client records
		$lead->save();

		//insert or update primary phone
		$personal_phone = $lead->get_phone('primary');
		$personal_phone->number = \Format::clean_number($form->number->val());
		$personal_phone->save();

		//insert note
		$note = $this->get_note();
		$note->user_id = $lead->id;
		$note->author_id = $lead->id;
		$note->type = 'inquiry';
		$note->note = $form->message->val();
		$note->save();

		// Start building the email
		$header = \View::factory('email/_header')
			->set('title', 'New Lead');
		$footer = \View::factory('email/_footer');
		$email_content = \View::factory('email/new_lead')
			->set('lead', $lead);

		$message = \View::factory('email/_template')
			->bind('header', $header)
			->bind('footer', $footer)
			->bind('content', $email_content);

		// Send the email
		$email_address = 'jneslen@yahoo.com';
		$subject = 'New PixelTenchi '.$lead->campaign->name.' Inquiry';
		$email = \Email::factory($subject)
			->to($email_address)
			->from('jeff@pixeltenchi.com')
			->message($message->render(), 'text/html')
			->send();
	}

	public function get_form($name = null)
	{
		$form = parent::get_form($name);

		$phone = $this->get_phone();
		$form->add('phone', 'group', $phone->get_form());

		$address = $this->get_address();
		$form->add('address', 'group', $address->get_form());

		$form->remove
		(
			array
			(
				'campaign_id',
				'ip',
				'inquiry_ip',
				'inquiry_date',
				'contact_date',
				'downloaded',
			)
		);

		$form->order
		(
			array
			(
				'full_name' => 0,
				'email' => 1,
			)
		);

		return $form;
	}

	public function get_lead_form($name = 'lead')
	{
		$form = \Formo::form($name)
			->add('campaign_id', 'hidden')
			->add('download', 'hidden')
			->add('name', array('label' => __('Full Name')))
			->add('email', array('type' => 'email', 'label' => 'Email'))
			->add('number', array('label' => __('Phone Number')))
			->add('message', 'textarea', array('label' => __('Message')))
			->rules('name', array(
			array('not_empty'),
			array('\Valid::full_name'),
		))
			->rules('email', array(
			array('not_empty'),
			array('email'),
		))
			->rules('number', array(
			array('not_empty'),
			array('phone', array(':value')),
		))
			->callbacks(array(
			'fail' => array
			(
				'email' => array
				(
					array(function($field){
						$error = $field->error();
						if (strpos($error, 'already'))
						{
							$field->parent()->set('fail_unique_email', true);
						}
					}, array(':field')),
				)
			),
			'pass' => array
			(
				':self' => array
				(
					array(array($this, 'create_new_lead'), array(':field')),
				),
			),
		));

		return $form;
	}
}
