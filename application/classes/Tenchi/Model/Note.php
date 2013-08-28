<?php

namespace Tenchi\Model;

class Note extends Model
{
	public function get_form($name = null)
	{
		$form = parent::get_form($name);

		$form->remove(array
		(
			'note_date',
			'disabled'
		));

		$form->note->set('driver', 'textarea');
		$form->user_id->set('driver', 'hidden');
		$form->author_id->set('driver', 'hidden');
		$form->parent_id->set('driver', 'hidden');

		return $form;
	}

	protected function _get_author()
	{
		return \Kacela::find('user', $this->author_id); //Gacela is having a difficult time getting the author for some reason, so this is a temp fix
	}

	protected function _get_sub_notes()
	{
		return \Kacela::find_active('note', \Kacela::criteria()->equals('parent_id',$this->id)->sort('note_date', 'Desc'));
	}
}