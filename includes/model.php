<?php
abstract class Model {
	protected $_db;
	
	public function __construct()
	{
		$this->_db = Database::getInstance();
	}
	
	public static function getModel($name)
	{
		include_once(Settings::getRoot() . '/models/' . strtolower($name) . '_model.php');
		$modelname = ucfirst(strtolower($name)) . 'Model';
		return new $modelname();
	}
}
