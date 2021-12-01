<?php
namespace R2Template;

/**
 * R2Template
 *
 * @package R2Template
 * @author Hiroyuki Suzuki
 * @copyright Copyright (c) 2021 Hiroyuki Suzuki mofg.net
 * @license http://opensource.org/licenses/MIT The MIT License
 */
class R2Template{
	/**
	 * @var array
	 */
	protected $vars = [];

	/**
	 * @var string
	 */
	protected $file = "";

	/**
	 * @param string $path (optional)
	 */
	public function __construct(protected string $path = ""){}

	/**
	 * @param string $path
	 */
	public function setPath(string $path){
		$this->path = $path;
	}

	/**
	 * @param string $name
	 * @param mixed $value
	 */
	public function set(string $name, $value){
		$this->vars[$name] = $value;
	}

	/**
	 * @param string $name
	 * @return mixed
	 */
	public function get(string $name){
		return ( isset($this->vars[$name]) ) ? $this->vars[$name] : null;
	}

	public function clearVars(){
		$this->vars = [];
	}

	/**
	 * @param string $file
	 * @param array $vars (optional)
	 * @param bool $usePath (optional)
	 * @return bool
	 */
	public function display(string $file, array $vars = [], bool $usePath = true){
		$this->file = ( $usePath ) ? rtrim($this->path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$file : $file;
		if( !file_exists($this->file) ){
			trigger_error("Template ({$this->file}) was not found.", E_USER_WARNING);
			return false;
		}else if( !is_readable($this->file) ){
			trigger_error("Template ({$this->file}) is not readable.", E_USER_WARNING);
			return false;
		}
		$this->_vars = array_merge($this->vars, $vars);
		unset($file);
		unset($vars);
		unset($usePath);
		extract($this->_vars);
		$result = include($this->file);
		return ( $result !== false ) ? true : false;
	}

	/**
	 * @param string $file
	 * @param array $vars (optional)
	 * @param bool $usePath (optional)
	 * @return string
	 */
	public function getContents(string $file, array $vars = [], bool $usePath = true){
		ob_start();
		$this->display($file, $vars, $usePath);
		$result = ob_get_contents();
		ob_end_clean();
		return $result;
	}

	/**
	 * @deprecated
	 */
	public function set_dir(string $path){
		return $this->setPath($path);
	}

	/**
	 * @deprecated
	 */
	public function clear_vars(){
		return $this->clearVars();
	}

	/**
	 * @deprecated
	 */
	public function get_contents(string $file, array $vars = [], bool $usePath = true){
		return $this->getContents($file, $vars, $usePath);
	}
}
