<?php
/**
 * @author Jeff Neslen
 * @date 4/19/12
 * @brief
 *
 */
defined('SYSPATH') OR die('No direct access allowed.');

$conf = Kohana::$config->load('local');

return array
(
	'namespaces' => array
	(
		'Tenchi' => APPPATH.'classes/',
		'Kacela' => MODPATH.'kacela/classes/kacela/'
	),
	'datasources' => array
	(
		'db' => array
		(
			'type' => 'database',
			'schema' => $conf['kacela']['schema'],
			'host' => $conf['kacela']['host'],
			'user' => $conf['kacela']['user'],
			'password' => $conf['kacela']['password']
		)
	),
	'cache' => $conf['kacela']['cache'],
	'profiling' => $conf['kacela']['profiling']
);