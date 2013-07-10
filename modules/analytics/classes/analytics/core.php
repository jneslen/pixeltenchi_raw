<?php defined('SYSPATH') or die('No direct script access.');

class Analytics_Core
{
	//hardcoding the the head and foot views for now just for ease of access
	//$key => $value are 'view' => array('uri', 'uri2')
	protected $_head_views = array('google_analytics_head' => 'all');
	protected $_foot_views = array();
	private $_view;

	public function __construct($config)
	{
		$this->_view = View::factory('analytics');

		//we can build something in later that determines what to include and what not to include depending on the environment for for now it is all or nothing.
		if(\Kohana::$environment != 'LIVE')
		{
			$this->_view->set('views', array());
			return;
		}

		switch($config)
		{
			case 'head':
				$view_array = $this->_head_views;
				break;
			case 'foot':
				$view_array = $this->_foot_views;
				break;
			default:
				$view_array = is_array($config) ? $config : array($config);
				break;
		}

		//need the current page to determine if the view are to be included in the current page
		$current = \Request::current()->uri();

		$views = array();
		foreach($view_array as $view => $uri)
		{
			if(is_array($uri))
			{
				if(in_array($current, $uri))
				{
					$views[] = View::factory($view);
				}
			}
			elseif($uri == 'all')
			{
				$views[] = View::factory($view);
			}
		}

		$this->_view->set('views', $views);
	}

	/**
	 * @param	string	$config	the config file that contains the menu array
	 * @return	Menu
	 */
	public static function factory($config = 'head')
	{
		return new Analytics($config);
	}

	public function render()
	{
		return $this->_view->render();
	}
}