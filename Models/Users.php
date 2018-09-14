<?php

namespace Models;

use App\Db;

class Users
{
	/**
	 * Return User by password and id
	 * @param $post
	 * @return bool
	 */
	public static function getUser($post)
	{
		$db = new Db();
		$data = array(
			'username' => $post['username'],
			'password' => $post['password']
		);
		$user = $db->execute("SELECT * FROM users WHERE username = :username AND password = :password LIMIT 1", $data);

		if($user){
			$_SESSION['admin'] = $user;
		}

		return true;
	}
}