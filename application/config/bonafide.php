<?php defined('SYSPATH') or die('No direct script access.');

return array(

	// Group name, multiple configuration groups are supported
	'default' => array(

		// Multiple mechanisms can be added for versioned passwords, etc
		'mechanisms' => array(
			// // bcrypt hashing using Blowfish encryption
			'bcrypt' => array('bcrypt', array(
				// number between 4 and 31, base-2 logarithm of the iteration count
				'cost' => 12
			)),
			// Support for our legacy passwords
			'legacy' => array('a1', array(
				'salt_pattern' => '1, 3, 5, 9, 14, 15, 20, 21, 28, 30',
			)),
		),
	),
);
