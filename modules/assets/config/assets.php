<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'css' => array
	(
		'extension' => 'less',
		'compile_path' => 'assets/css/',
		'template_path' => 'assets/less/',
		'lock' => false,
		'minify' => false
	),

	'js' => array
	(
		'compile_path' => 'assets/js/compiled/',
		'template_path' => 'assets/js/',
		'lock' => false,
		'compile' => false,
		'minify' => false
	)
);
