<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'driver' => 'file', // you can use 'database' or 'file', database uses ORM driver
	'view' => 'menu/public', // the view file
	'current_class' => 'active', // the set_current() method uses this setting to mark the current menu item

	'items' => array
	(
		array
		(
			'url'		=> '/portfolio',
			'title'		=> __('portfolio').'<h6>'.__('pixel creation').'</h6>',
			'type'		=> 'main',
		),
		array
		(
			'url'		=> '/about',
			'title'		=> __('about').'<h6>'.__('the creator').'</h6>',
			'type'		=> 'main',
		),
		array
		(
			'url'		=> '/inquire',
			'title'		=> __('inquire').'<h6>'.__('send me a prayer').'</h6>',
			'type'		=> 'main',
		),
	),

);