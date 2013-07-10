<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Public_Portfolio extends Controller_Public
{

	public function before()
	{
		parent::before();
		$this->_title = 'PixelTenchi: Portfolio';
		$this->request->scripts(
			array
				(
					'plugins/jquery.isotope',
					'portfolio',
				)
		);

		$this->request->style('isotope');
	}

	public function action_index()
	{
		$categories = \Kacela::load('creation')->get_types();
		$tags = \Kacela::find_active('tag');
		$creations = \Kacela::find_active('creation', \Kacela::criteria()->sort('creation_date', 'DESC'));
		$filter_box = \View::factory('portfolio_filters')
			->set('categories', $categories)
			->set('tags', $tags);

		$this->_content = \View::factory('portfolio')
			->set('filter_box', $filter_box)
			->set('creations', $creations);
	}

	public function action_detail()
	{
		$creation_id = $this->request->param('id');

		$creation = \Kacela::find_one('creation', \Kacela::criteria()->equals('id', $creation_id));

		$this->_title = $creation->title;

		$this->_content = \View::factory('portfolio/detail')
			->set('creation', $creation);
	}

}