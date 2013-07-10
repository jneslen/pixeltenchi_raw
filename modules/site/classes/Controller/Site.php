<?php defined('SYSPATH') OR die('No direct access allowed.');

class Controller_Site extends Controller_Template
{
	public $template = 'public';

	protected $_title = '';
	protected $_page_title = '';
	protected $_description = '';
	protected $_keywords = '';

	protected $_session;

	protected $_subrequest;

	protected $_content;

	protected $_section = 'public';

	protected $_theme_name = 'griffin';
	protected $_theme_path = 'themes/';

	protected $_campaign;

	protected $_modal;
	protected $_modal_type = 'form';
	protected $_modal_title = null;
	protected $_modal_subtitle = null;
	protected $_modal_content = null;
	protected $_modal_view;
	protected $_modal_button_name = 'Close';

	protected $_lead_form;
	protected $_lead_form_render = true;
	protected $_lead_download;
	protected $_lead_form_hide = true;

	protected function _authenticate()
	{
		return true;
	}

	public function before()
	{
		parent::before();

		$this->_session = Session::instance();

		$this->_set_user();
		$this->_kick_out();

		if($this->request->is_initial() === false)
		{
			// Subrequests are marked internal
			$this->_subrequest = true;
		}

		// Javascript files
		$this->request->script('jquery');

		if(!$this->request->is_ajax())
		{
			$this->request->script('pixeltenchi');
		}

		$this->request->scripts
		(
			array
			(
				'jquery.ui',
				'plugins/jquery.pngfix',
				'plugins/jquery.form',
				'bootstrap.min',
				'site',
			)
		);

		// Stylesheets
		$this->request->styles
		(
			array
			(
				'vars',
				'jquery.ui',
				'icons',
				'forms',
				'bootstrap/bootstrap',
				'bootstrap/responsive',
				$this->_theme_name.'/styles'
			)
		);

		View::bind_global('title', $this->_title);
		View::bind_global('page_title', $this->_page_title);
		View::bind_global('user', $this->_user);

		$this->_campaign = \Cookie::get('campaign_id', '1');
	}

	public function after()
	{
		if(empty($this->_page_title))
		{
			$this->_page_title = $this->_title;
		}

		if($this->_modal)
		{
			$this->_modal_view = \View::factory('modal')
				->set('title', $this->_modal_title)
				->set('subtitle', $this->_modal_subtitle)
				->set('content', $this->_modal_content)
				->set('type', $this->_modal_type)
				->set('button_name', $this->_modal_button_name);
		}

		$this->template->header = \View::factory($this->_theme_path.$this->_theme_name.'/header');
		$this->template->footer = \View::factory($this->_theme_path.$this->_theme_name.'/footer');

		if ($this->request->is_ajax())
		{
			$this->template = $this->_content;
		}
		else
		{
			$role = explode('_', get_parent_class($this));
			$role = strtolower(end($role));

			$this->template->description = $this->_description;

			$this->template->keywords = $this->_keywords;

			$this->template->head_analytics = \Analytics::factory('head');

			$this->template->foot_analytics = \Analytics::factory('foot');

			$this->template->header->menu = \Menu::factory($role)->set_current('/'.strtolower($this->request->controller()));

			$this->template->header->section = $this->_section;

			$this->template->content = $this->_content;

			$this->template->modal = $this->_modal_view;

			$this->template->lead_form = $this->_lead_form_render ? $this->_lead_form : null;
		}
		parent::after();
	}

	protected function _redirect_after_login()
	{
		if ($this->_user instanceof \Tenchi\Model\Employee)
		{
			$this->redirect('admin');
		}

		$this->redirect('login');
	}

	protected function _get_current()
	{
		$string = '';

		if($this->request->directory() != 'public')
		{
			$string .= '/'.$this->request->directory();
		}

		$string .= '/'.$this->request->controller();

		return $string;
	}

	protected function _kick_out()
	{
		// By default, do nothing
		return;
	}

	protected function _set_user()
	{
		$user_id = $this->_session->get('user_id');

		$this->_user = $user_id
			? \Kacela::find('user', $user_id)
			: new \Tenchi\Model\User;
	}
}