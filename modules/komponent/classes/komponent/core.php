<?php defined('SYSPATH') or die('No direct script access.');


class Komponent_Core {

	protected $_components;

	/**
	 * @param	string	$config	 see factory()
	 */
	public function __construct($config)
	{
		$this->config = Kohana::$config->load($config);

		if ($this->config['driver'] == 'database')
		{
			//$this->components = new \Tenchi\Model\Component();
			$this->_components = \Kacela::find_active('component');
		}
		elseif($this->config['driver'] == 'file')
		{
			$this->_components = array('components' => &$this->config['components']);
		}

	}

	/**
	 * @param	string	$config	the config file that contains the component array
	 * @return	Komponent
	 */
	public static function factory($config = 'component')
	{
		return new Komponent('komponent/'.$config);
	}

	public function replace(\Tenchi\Model\Content $content)
	{
		foreach($this->_components as $component)
		{
			//Only run the component switch if the component name is present in the content
			if(strpos($content->content, $component->name) !== false)
			{
				switch($component->type)
				{
					//TODO: define model component actions
					case 'model':

						break;
					case 'method':
						$mycontroller = $component->directory ? 'Controller_'.ucfirst($component->directory).'_'.ucfirst($component->controller) : 'Controller_'.ucfirst($component->controller);
						$controller = new $mycontroller(\Request::current(), \Response::factory());
						$replacement = $controller->{$component->method}($component->vars);
						$content->content = str_replace($component->name, $replacement, $content->content);
						break;
					case 'view':
						if($component->language)
						{
							$replacement = \View::factory($component->view, array('language' => true));
						}
						else
						{
							$replacement = \View::factory($component->view);
						}
						$content->content = str_replace($component->name, $replacement, $content->content);
						break;
					case 'content':
						$content->content = str_replace($component->name, $component->content, $content->content);
						break;
				}
			}
		}

		return $content;
	}

	/**
	 * @param object $items object ORM that contains main menu items
	 * @return array array that contains menu items from database
	 */
	private function get_from_database($components) {
		$temp = array();

		foreach ($items as $key => $item) {
			$temp[$key]['url'] = $item->url;
			$temp[$key]['title'] = $item->title;
			if ($item->classes) {
				$temp[$key]['classes'] = array($item->classes);
			}
			$subcategories = $item->sub_menu;
			if (count($subcategories) > 0)
				$temp[$key]['items'] = $this->get_from_database($subcategories);
		}

	}
}