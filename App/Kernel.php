<?php

namespace App;

use App;

/**
 * Class Kernel
 * @package App
 */
class Kernel
{
	public $defaultControllerName = 'Home';

	public $defaultActionName = 'index';

	/**
	 * Return data for activating controller
	 */
	public function launch()
	{
		list($controllerName, $actionName, $params) = App::$router->resolve();
		echo $this->launchAction($controllerName, $actionName, $params);
	}

	/**
	 * Launching action specified in launch method
	 * @param $controllerName
	 * @param $actionName
	 * @param $params
	 * @return mixed
	 */
	public function launchAction($controllerName, $actionName, $params)
	{
		$controllerName = empty($controllerName) ? $this->defaultControllerName : ucfirst($controllerName);
		if(!file_exists(ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php')){
			echo 'wrong url';
			exit();
		}
		require_once ROOTPATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.$controllerName.'.php';
		if(!class_exists("\\Controllers\\".ucfirst($controllerName))){
			echo 'wrong url';
			exit();
		}
		$controllerName = "\\Controllers\\".ucfirst($controllerName);
		$controller = new $controllerName;
		$actionName = empty($actionName) ? $this->defaultActionName : $actionName;
		if(!method_exists($controller, $actionName)){
			echo 'wrong url';
			exit();
		}
		return $controller->$actionName($params);
	}
}