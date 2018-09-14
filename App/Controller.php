<?php

namespace App;

class Controller
{
	public $layoutFile = 'Views/Layout.php';

	/**
	 * Render layout template
	 * @param $body
	 * @return string
	 */
	public function renderLayout($body)
	{
		ob_start();
		require ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'Layout'.DIRECTORY_SEPARATOR.'Layout.php';
		return ob_get_clean();
	}

	/**
	 * Render controller view
	 * @param $viewName
	 * @param array $params
	 * @return string
	 */
	public function render($viewName, array $params = [])
	{
		$viewFile = ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.$viewName.'.php';
		extract($params);
		ob_start();
		require $viewFile;
		$body = ob_get_clean();
		if(defined('NO_LAYOUT')){
			return $body;
		}
		return $this->renderLayout($body);
	}

	/**
	 * Redirect user to Home page
	 */
	public function redirectHome()
	{
		header('Location: /Home');
	}
}