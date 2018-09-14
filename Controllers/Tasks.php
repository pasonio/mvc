<?php

namespace Controllers;

use Models\Tasks as ModelTasks;

class Tasks extends \App\Controller
{

	/**
	 *Display new task form
	 *Redirect to home page on success
	 * @return string
	 * @throws \Gumlet\ImageResizeException
	 */
	public function add()
	{
		$post = isset($_POST['Task']) ? $_POST['Task'] : '';
		$files = isset($_FILES) ? $_FILES : '';
		if(!empty($post)){
			if(ModelTasks::addNewItem($post, $files)){
				$this->redirectHome();
			}
		}
		return $this->render('Add');
	}

	/**
	 * Update existing task if user has permissions
	 * Redirect to home page on success
	 * @return string
	 */
	public function update()
	{
		$id = $_GET['id'];
		$post = isset($_POST['Task']) ? $_POST['Task'] : '';
		if(!empty($post)){
			if(ModelTasks::updateTask($post, $id)){
				$this->redirectHome();
			}
		}
		$model = ModelTasks::getTask($_GET['id']);
		return $this->render('Update', ['model' => $model]);
	}

}