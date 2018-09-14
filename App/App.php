<?php


class App
{
	/**
	 * @var App\Router instance
	 */
	public static $router;

	/**
	 * @var App\Db instance
	 */
	public static $db;

	/**
	 * @var App\Kernel core instance
	 */
	public static $kernel;

	/**
	 * Initialize App class
	 */
	public static function init()
	{
		spl_autoload_register(['static', 'loadClass']);
		static::bootstrap();
		set_exception_handler(['App', 'handleException']);
	}

	/**
	 * Create instance of Router, Kernel and Db classes
	 */
	public static function bootstrap()
	{
		static::$router = new App\Router();
		static::$kernel = new App\Kernel();
		static::$db = new App\Db();
	}

	/**
	 * Find class in project and load it
	 * @param $className
	 */
	public static function loadClass($className)
	{
		$className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
		require_once ROOTPATH.DIRECTORY_SEPARATOR.$className.'.php';
	}

	/**
	 * @param Throwable $e
	 */
	public static function handleException(Throwable $e)
	{
		if($e instanceof \App\Exceptions\InvalidRouteException){
			echo static::$kernel->launchAction('Error', 'error404', [$e]);
		}else{
			echo static::$kernel->launchAction('Error', 'error500', [$e]);
		}
	}
}