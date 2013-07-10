<?php defined('SYSPATH') OR die('No direct access allowed.');

require MODPATH.'/assets/vendor/jsmin/jsmin.php';

require MODPATH.'/assets/vendor/lessphp/lessc.inc.php';

class Assets_Core {

	protected $_config;

	protected $_css_path;

	protected $_js_path;

	protected $_name;

	protected $_styles = array();

	protected $_scripts = array();

	protected function _normalize_path($path, $prefix = null)
	{
		if(is_null($prefix))
		{
			$prefix = dirname(APPPATH).DIRECTORY_SEPARATOR;
		}

		$path = str_replace('/', DIRECTORY_SEPARATOR, $path);
		if(!preg_match('/^([A-Za-z]:)*[\/\\\]/', $path) AND !$this->_is_external($path))
		{
			if(!preg_match('/[\/\\\]$/', $path))
			{
				$path .= DIRECTORY_SEPARATOR;
			}

			$path = $prefix.$path;
		}

		return $path;
	}

	protected function _is_external($path)
	{
		return stripos($path, 'http') === 0;
	}

	/**
	 * Minifies CSS using simple techniques
	 *
	 * @param   string  The css that needs to be minified
	 * @return  string  The minified version of the css
	 */
	protected function _minify($css)
	{
		// Remove whitespace from ends
		$css = trim($css);

		// Remove any consecutive whitespace
		$css = preg_replace('#\s+#', ' ', $css);

		// Remove any CSS comments
		$css = preg_replace('#/\*.*?\*/#s', '', $css);

		// Remove any unncessary whitespace or punctuation
		$replacements = array
		(
			'; ' => ';',
			': ' => ':',
			' {' => '{',
			'{ ' => '{',
			', ' => ',',
			'} ' => '}',
			';}' => '}',
		);
		$css = str_replace(array_keys($replacements), array_values($replacements), $css);

		return $css;
	}

	/**
	 * Basic factory method, simply for chaining
	 */
	public static function factory($name)
	{
		return new Assets($name);
	}

	public function __construct($name)
	{
		$this->_name = $name;
		$this->_config = array
		(
			'css' => Kohana::$config->load('assets.css'),
			'js' => Kohana::$config->load('assets.js')
		);

		$local = Kohana::$config->load('assets.'.$name);

		if(Arr::is_array($local))
		{
			$this->_config = array_merge($this->_config,$local);
		}

		$this->_config['css']['public_path'] = $this->_config['css']['compile_path'];
		$this->_config['css']['compile_path'] = $this->_normalize_path($this->_config['css']['compile_path']);
		$this->_config['css']['template_path'] = $this->_normalize_path($this->_config['css']['template_path']);
		if($this->_config['js']['compile'])
		{
			$this->_config['js']['public_path'] = $this->_config['js']['compile_path'];
		}
		else
		{
			$this->_config['js']['public_path'] = $this->_config['js']['template_path'];
		}
		$this->_config['js']['compile_path'] = $this->_normalize_path($this->_config['js']['compile_path']);
		$this->_config['js']['template_path'] = $this->_normalize_path($this->_config['js']['template_path']);
	}

	public function style($path)
	{
		$this->_styles[] = $path;
	}

	public function script($path)
	{
		$this->_scripts[] = $path;
	}

	public function styles($paths = null)
	{
		$config = $this->_config['css'];

		if(!is_null($paths))
		{
			$this->_styles = array_merge($this->_styles, $paths);

			return $this;
		}

		// Setup external links
		$links = '';
		foreach($this->_styles as $path)
		{
			if($this->_is_external($path))
			{
				$links .= HTML::style($path)."\n";
			}
		}

		$files = glob($config['compile_path'].$this->_name.'_*.css');

		// At some point allow locking

		$ext = $config['extension'];

		$hash = '';

		foreach($this->_styles as $path)
		{
			$path .= '.'.$ext;
			//echo \Debug::vars($path);
			//echo \Debug::vars($config['template_path']);
			//exit;
			if(!$this->_is_external($path))
			{
				$hash .= filemtime($this->_normalize_path($config['template_path'].$path));
			}
		}

		// Determine current hash

		$hash = sha1($hash);
		// Look for file with matching hash, if the files don't match delete.
		foreach($files as $file)
		{
			if(stristr($file, $hash))
			{
				$file = explode(DIRECTORY_SEPARATOR, $file);
				$file = end($file);

				$links .= HTML::style($config['public_path'].$file)."\n";
				$return = true;
			}
			else
			{
				unlink($file);
			}
		}


		if(isset($return))
		{
			return $links;
		}

		// If it doesn't exist create a new file with compiled hash.

		$less = '';

		foreach($this->_styles as $path)
		{
			if(!$this->_is_external($path))
			{
				$path .= '.'.$ext;
				$less .= file_get_contents($config['template_path'].$path);
			}
		}

		$name = $this->_name.'_'.$hash.'.css';

		// Instantiate LESS compiler
		$compiler = new lessc();

		// Importing should be done by the module so that modified times can be compared
		//$compiler->importDisabled = FALSE;

		//search import folders
		$compiler->setImportDir(array('assets/less/', 'assets/less/bootstrap'));

		// Parse the LESS file and convert to CSS
		$css = $compiler->parse($less);

		// Minify the CSS if configured to do so
		if ($config['minify'])
		{
			$css = $this->_minify($css);
		}

		file_put_contents($config['compile_path'].$name, $css);

		// Return link to compiled stylesheet
		$links .= HTML::style($config['public_path'].$name);

		return $links;
	}


	public function scripts($paths = null)
	{
		if(!is_null($paths))
		{
			$this->_scripts = array_merge($this->_scripts, $paths);

			return $this;
		}

		$config = $this->_config['js'];

		$links = '';
		foreach($this->_scripts as $path)
		{
			$links .= HTML::script($config['public_path'].$path.'.js')."\n";
		}

		return $links;
	}

} // End Assets