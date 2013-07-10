<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Formo_Driver_Submit_Core class.
 *
 * @package   Formo
 * @category  Drivers
 */
class Formo_Driver_Submit extends Formo_Driver {

	protected $_view_file = 'submit';

	public function html()
	{
		$value = ($val = $this->_field->val())
			? $val
			: $this->_view->label();

		$this->_view
			->set_var('tag', 'button')
			->attr('class', 'btn btn-primary')
			->attr('name', $this->name())
			->attr('value', $value);

		if ( ! $this->_view->text())
		{
			$this->_view->text($this->_field->alias());
		}
	}

	public function sent()
	{
		return $this->_field->not_empty() !== FALSE;
	}

}