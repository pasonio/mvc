<?php

namespace App;

class Router
{
	/**
	 * Parse url and send to controller
	 * @return mixed
	 */
	public function resolve()
	{
		if(($pos = strpos($_SERVER['REQUEST_URI'], '?')) !== false){
			$route = substr($_SERVER['REQUEST_URI'], 0, $pos);
		}else {
			$route = null;
		}
		$route = is_null($route) ? $_SERVER['REQUEST_URI'] : $route;
		$route = explode('/', $route);
		array_shift($route);
		$result[0] = array_shift($route);
		$result[1] = array_shift($route);
		$result[2] = $route;
		return $result;
	}

	public static function generateFilterHtml($regex)
	{
		$currentURI = rtrim($_SERVER['REQUEST_URI'], '?');
		$currentURI = preg_replace($regex, '', $currentURI);
		$start = explode('?', $currentURI);
		$additional = explode('&', $currentURI);
		if(count($start) > 1 && count($additional) <= 1){
			$currentURI = $currentURI.'&';
		}elseif(count($additional) > 1 && count($start) <= 1) {
			$currentURI = $additional[0].'?'.$additional[1].'&';
		} else {
			$currentURI = $currentURI.'?';
		}

		return $currentURI;
	}

	public static function generateSortHtml()
	{
		return self::generateFilterHtml('~\?sort=[a-z]+|&sort=[a-z]+~');
	}
}