<?php

namespace Tenchi\Model;

class Phone extends Model
{
	public function get_form($name = null)
	{
		$form = parent::get_form($name);

		$form->remove(array('disabled'));

		$form->set('label', ucfirst($this->type).' Phone');
		$form->number->set('label', 'Phone number');
		$form->number->set('value', $this->formatted_phone);
		$form->user_id->set('driver', 'hidden');
		$form->type->set('driver', 'hidden');
		$form->add('type', 'hidden', array('value' =>$this->type));
		$form->rules('number', array
		(
			array('not_empty'),
			array
			(
				'\Valid::phone',
				array
				(
					':value',
					array(10,11,12,18)
				)
			)
		));

		$form->callbacks(array(
			'pass' => array
			(
				':self' => array
				(
					array(array($this, 'save'), array(':value')),
				),
			),
		));

		return $form;
	}

	protected function _get_formatted_phone()
	{
		return \Format::phone($this->number, $this->format);
	}

	protected function _set_number($value)
	{
		$this->_originalData['number'] = $this->_data->number;
		$this->_data->number = preg_replace('/\D/', '', $value);
		$this->_changed[] = 'number';
	}
}