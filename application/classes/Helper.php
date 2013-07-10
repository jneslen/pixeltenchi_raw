<?php

class Helper
{
	static public function directory_list($directory, $self_value = true)
	{
		$directory = DOCROOT.$directory;
		// create an array to hold directory list
		$results = array();

		// create a handler for the directory
		$handler = opendir($directory);

		// open directory and walk through the filenames
		while($file = readdir($handler))
		{
			// if file isn't this directory or its parent, add it to the results
			if($file != "." AND $file != "..")
			{
				//set key value pair to self otherwise leave as standard array key value
				if($self_value)
				{
					$results[$file] = $file;
				}
				else
				{
					$results[] = $file;
				}
			}

		}

		// tidy up: close the handler
		closedir($handler);

		// done!
		return $results;
	}

	static public function array_to_object(array $array)
	{
		foreach($array as $key => $value)
		{
			if(is_array($value))
			{
				$array[$key] = self::array_to_object($value);
			}
		}
		return (object)$array;
	}

	//This will return the language that needs to be displayed for the site.
	static public function language()
	{
		if(\Kohana::$environment === 'LIVE')
		{
			$base_url = $_SERVER['HTTP_HOST'];
			//$base_url = 'pixeltenchi';
		}
		elseif(\Kohana::$environment === 'DEV-JP')
		{
			$base_url = 'http://jp.pixeltenchi.com';
		}
		else
		{
			$base_url = 'http://www.pixeltenchi.com';
		}

		preg_match('/(http:\/\/)?(([^.]+)\.)?pixeltenchi\.com/', $base_url, $regs);
		//preg_match("/.([a-z]{2,3})\/?$/", $base_url, $regs);

		switch(strtolower($regs[3]))
		{
			case 'jp':
				$language = 'jp';
				break;
			default:
				$language = 'en-us';
				break;
		}

		return $language;
	}

	static public function object_to_array($object)
	{
		$array = array();
		foreach($object as $key => $value)
		{
			$array[$key] = $value;
		}
		return $array;
	}
}