<?php

namespace App;

class Db
{
	/**
	 * Global variable for PDO connection
	 * @var \PDO
	 */
	public $pdo;

	/**
	 * Db constructor.
	 */
	public function __construct()
	{
		$settings = $this->getPDOSettings();
		$this->pdo = new \PDO($settings['dsn'], $settings['user'], $settings['pass'], null);
	}

	/**
	 * Retrive settings for database table from config directory
	 * @return mixed
	 */
	protected function getPDOSettings()
	{
		$config = include ROOTPATH.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'Db.php';
		$result['dsn'] = "{$config['type']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
		$result['user'] = $config['user'];
		$result['pass'] = $config['pass'];
		return $result;
	}

	/**
	 * Return data according to query
	 * @param $query
	 * @param array|null $params
	 * @return array
	 */
	public function execute($query, array $params = null)
	{
		if(is_null($params)){
			$stmt = $this->pdo->query($query);
			$stmt->setFetchMode(\PDO::FETCH_NAMED);
			return $stmt->fetchAll();
		}
		$stmt = $this->pdo->prepare($query);
		$stmt->setFetchMode(\PDO::FETCH_ASSOC);
		$stmt->execute($params);
		return $stmt->fetchAll();
	}

	/**
	 * Insert data according to query
	 * @param $query
	 * @param $params
	 * @return bool
	 */
	public function insert($query, $params)
	{
		$stmt = $this->pdo->prepare($query);
		$result = $stmt->execute($params);
		return $result;
	}

}