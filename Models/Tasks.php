<?php

namespace Models;

use App\Db;
use Gumlet\ImageResize;

class Tasks
{
	const DEFAULT_TASK_AMOUNT = 3;
	/**
	 * Return status name in human language
	 * @return array
	 */
	public static function statusName()
	{
		return array(
			0 => 'Not Done',
			1 => 'Done'
		);
	}

	/**
	 * Return total number of tasks
	 * @return mixed
	 */
	public static function getTotalTaskAmount()
	{
		$db = new Db();
		$result = $db->execute("SELECT count(id) as count FROM tasks");
		return $result[0]['count'];
	}

	/**
	 * Display all available tasks
	 * @param $page
	 * @return array
	 */
	public static function showTasksList($page)
	{
		$db = new Db();
		$offset = ($page - 1) * self::DEFAULT_TASK_AMOUNT;
		$query = "SELECT * FROM tasks ";
		if(isset($_GET['sort'])){
			$query .= self::sortTasksTable();
		}
		$query .= "LIMIT ".self::DEFAULT_TASK_AMOUNT;
		$query .=  " OFFSET ".$offset;
		$list = $db->execute($query);
		return $list;
	}

	/**
	 * Sort tale according to get parameter
	 * @return string
	 */
	public static function sortTasksTable()
	{
		$sort_array = $_GET['sort'];
		switch ($sort_array) {
			case 'username':
				return ' ORDER BY username ASC ';
			case 'email':
				return ' ORDER BY email ASC ';
			case 'status':
				return ' ORDER BY status DESC ';
		}
	}

	/**
	 * Create new Task
	 * @param $post
	 * @param $files
	 * @return bool
	 * @throws \Gumlet\ImageResizeException
	 */
	public static function addNewItem($post, $files)
	{
		$db = new Db();
		if(!empty($files)){
			$image = self::editFormFile($files);
		} else {
			$image = null;
		}
		$data = array(
			'username' => $post['username'],
			'email' => $post['email'],
			'task_description' => $post['task_description'],
			'image' => $image
		);
		return $db->insert(
			"INSERT INTO tasks (username, email, task_description, image) 
			VALUES (:username, :email, :task_description, :image)", $data);
	}

	public static function updateTask($post, $id)
	{
		$db = new Db();
		$data = array(
			'username' => $post['username'],
			'email' => $post['email'],
			'task_description' => $post['task_description'],
			'status' => isset($post['status']) ? 1 : 0
		);
		return $db->insert(
		"UPDATE tasks SET username = :username, email = :email, task_description = :task_description, status = :status WHERE id = $id",
		$data);
	}

	public static function getTask($id)
	{
		$db = new Db();

		$model = $db->execute("SELECT * FROM tasks WHERE id = $id LIMIT 1");

		return $model[0];

	}

	/**
	 * Check image extension and resize if its dimension bigger than allowed
	 * @param $files
	 * @return bool|string
	 * @throws \Gumlet\ImageResizeException
	 */
	public static function editFormFile($files)
	{
		$name = $files['Task']['name']['task_image'];
		$target_dir = 'Uploads/';
		$target_file = $target_dir . $name;

		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		$extensions_arr = array("jpg","png","gif");

		if( in_array($imageFileType,$extensions_arr) ) {

			$image_name = $files['Task']['tmp_name']['task_image'];
			list($width, $height) = getimagesize($image_name);

			if($width > 320 && $height > 240){
				self::resizeImage($files['Task']['tmp_name']['task_image']);
			}

			$image_base64 = base64_encode(file_get_contents($files['Task']['tmp_name']['task_image']));
			$image = 'data:image/' . $imageFileType . ';base64,' . $image_base64;

			return $image;
		} else {
			return false;
		}

	}

	/**
	 * Resize image if it too big
	 * @param $file
	 * @return mixed
	 * @throws \Gumlet\ImageResizeException
	 */
	public static function resizeImage($file)
	{
		$image = new ImageResize($file);
		$image->resizeToBestFit(320, 240);
		$image->save($file);
		return $file;
	}

	public function tableManipulationHandler($request)
	{
		$table_manipulration = $_SERVER['REQUEST_URI'];
		if(strpos($table_manipulration, '?')){
			$table_manipulration .= '&'.$request;
		} else{
			$table_manipulration = '?'.$request;
		}

		return $table_manipulration;
	}
}