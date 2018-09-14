<?php

namespace Controllers;

use App\Pagination;
use Models\Tasks;
use Models\Users;

class Home extends \App\Controller
{
	/**
	 * Display Home page
	 * @return string
	 */
	public function index()
	{
		if(isset($_GET['page_number'])){
			$current_page = $_GET['page_number'];
		}else{
			$current_page = 1;
		}

		$total = Tasks::getTotalTaskAmount();

		$tasks_list = Tasks::showTasksList($current_page);

		$pagination = new Pagination($total, $current_page, Tasks::DEFAULT_TASK_AMOUNT, 'page_number');

		return $this->render('Home', ['tasks_list' => $tasks_list, 'pagination' => $pagination]);
	}

	/**
	 * Display Login form
	 * @return string
	 */
	public function login()
	{
		$post = isset($_POST['User']) ? $_POST['User'] : '';
		if(!empty($post)){
			if(Users::getUser($post)){
				$this->redirectHome();
			}
		}
		return $this->render('Login');
	}
}