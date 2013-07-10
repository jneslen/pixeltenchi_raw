<?php

class Request extends Kohana_Request
{
	protected static $valid_types = array('error', 'success', 'warning');

	protected static $duration = 1;

	protected $_alert = false;

	protected $_assets = null;

	protected $_status = 'success';

	public function alert($type = null, $msg = null, $subject = null, $duration = null)
	{
		if(is_null($type))
		{
			return $this->_alert;
		}

		if ( ! in_array($type, self::$valid_types))
		{
			throw new Kohana_Exception('Alert type must be one of the following: :types', array(':types' => implode(', ', self::$valid_types)));
		}

		$this->_alert = array
		(
			'type'		=> $type,
			'msg'		=> str_replace('"', '\"', $msg),
			'subject'	=> $subject,
			'duration'	=> (!is_null($duration)) ? $duration : self::$default_duration,
		);

		return $this;
	}

	public function status($type = null)
	{
		if(is_null($type))
		{
			return $this->_status;
		}

		if ( ! in_array($type, self::$valid_types))
		{
			throw new Kohana_Exception('Status type must be one of the following: :types', array(':types' => implode(', ', self::$valid_types)));
		}

		$this->_status = $type;

		return $this;
	}

	public function script($path)
	{
		$this->_createAssets();

		$this->_assets->script($path);
	}

	public function style($path)
	{
		$this->_createAssets();

		$this->_assets->style($path);

		return $this;
	}

	public function scripts($paths = null)
	{
		if(is_null($paths))
		{
			return $this->_assets->scripts();
		}

		$this->_createAssets();

		$this->_assets->scripts($paths);

		return $this;
	}

	public function styles($paths = null)
	{
		if(is_null($paths))
		{
			return $this->_assets->styles();
		}

		$this->_createAssets();

		$this->_assets->styles($paths);

		return $this;
	}

	protected function _createAssets()
	{
		if(is_null($this->_assets))
		{
			$this->_assets = \Assets::factory($this->_directory);
		}
	}
}