<?php
/**
 * @author jneslen
 * @date 7/21/12
 * @brief
 *
 */

namespace Tenchi\Model;

use Kacela\Model as M;

class Model extends M\Model
{
	public function del($flag = true)
	{
		if(property_exists($this->_data, 'disabled') AND $flag)
		{
			$this->disabled = 1;

			return $this->save();
		}
		else
		{
			return $this->delete();
		}
	}

	public function get_form($name = null)
	{
		if(is_null($name)) {
			$name = get_class($this);
			$name = explode('\\', $name);
			$name = end($name);
		}

		$form = \Formo::form($name);

		foreach ($this->_fields as $field => $data)
		{
			if($data->primary === true && $data->sequenced === true)
			{
				continue;
			}

			$form->append($this->_formo_field($field, $data, $this->$field));
		}

		foreach ($form->as_array() as $alias => $val)
		{
			if ($field = \Arr::get($this->_fields, $alias))
			{
				$rules = $this->_formo_rules($field);

				if(!empty($rules))
				{
					$form->rules($alias, $rules);
				}
			}
		}

		return $form;
	}

	public function load_array(array $array)
	{
		foreach($array as $key => $val)
		{
			$this->$key = $val;
		}

		return $this;
	}

	public function markdown($field)
	{
		return \Markdown::instance()->transform($this->{$field});
	}

	public function save($data = null)
	{
		if($data instanceof \Formo_Form)
		{
			$data = $data->val();
		}

// Inject parent save method to add $field::transform()
		if(!$this->validate($data)) {
			return false;
		}


		$data = $this->_mapper()->save($this->_changed, $this->_data, $this->_originalData);

		if($data === false) {
			return false;
		}

		$field = $this->_field();

		foreach($this->_fields as $name => $meta)
		{
			if (array_key_exists($name, $data))
			{
				$value = $data->$name;
			}
			else
			{
				$value = $meta->default;
			}

			$data->$name = $field::transform($meta, $value, false);
		}

		$this->_data = $data;
		unset($data);

		$this->_changed = array();
		$this->_originalData = array();

		return true;
// End parent save method
	}

	public function validate(array $data = null)
	{
		return parent::validate($this->_filter_values($data));
	}

	protected function _field()
	{
		return $this->_singleton()->autoload("\\Field\\Field");
	}

	protected function _filter_values(array $array = null)
	{
		if(is_null($array))
		{
			return null;
		}

		$values = array();
		foreach ($array as $field => $value)
		{
			if (property_exists($this->_data, $field) || method_exists($this, '_set_'.$field)) {
				$values[$field] = $value;
			}
		}

		return $values;
	}

	protected function _formo_rules($field)
	{
		$rules = array();

		if ($field->null === FALSE AND $field->type != 'bool') {
// Add not_empty rule if it doesn't allow NULL
			$rules[] = array('not_empty');
		}

		if ($field->type == 'int') {
			$rules[] = array('digit');
		}

		if ($field->length) {
			$rules[] = array('max_length', array(':value', $field->length));
		}

		if ($field->type == 'enum') {
			$rules[] = array('in_array', array(':value', $field->values));
		}

		if ($field->type == 'date') {
			$rules[] = array('date');
		}

		return $rules;
	}

	protected function _formo_field($field, $data, $value)
	{
		$array = array('alias' => $field, 'value' => $value, 'driver' => 'input');

		switch ($data->type)
		{
			case 'enum':
				$keys = $data->values;
				array_walk($keys, function(&$k) { $k = ucfirst($k); });

				$array['driver'] = 'select';
				$array['options'] = array_combine($data->values, $keys);
				break;
			case 'bool':
				$array['driver'] = 'bool';
				break;
			case 'date':
				$array['value'] = \Format::date($this->$field);
				$array['attr']['class'] = 'datepicker';
				break;
			default:
				if($data->length <= 10) {
					$class = 'small';
				} elseif ($data->length <= 20) {
					$class = 'med';
				} else {
					$class = 'big';
				}

				$array['attr']['class'] = $class;
				break;
		}

		$label = explode('_', $field);
		array_walk($label, function(&$word) { $word = ucfirst($word); });
		$array['label'] = join(' ', $label);

		return \Formo::field($array);
	}

}