<?php
Route::set
(
	'sections',
	'<directory>(/<controller>(/<action>(/<id>(/<parentid>))))',
	array
	(
		'directory' => '(client|admin|api|crons)',
	)
)
	->defaults
(
	array
	(
		'controller' => 'index',
		'action'     => 'index',
	)
);

Route::set
(
	'default',
	'(<controller>(/<action>(/<id>)))')
		->defaults(
		array
		(
			'controller'	=> 'index',
			'action'		=> 'index',
			'directory'		=> 'public',
		)
);