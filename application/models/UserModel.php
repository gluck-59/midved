<?php

    class UserModel extends CI_Model
    {
		private $userId;
		private $userName;

		public function __construct()
		{
			parent::__construct();
			self::auth();
		}


		public function auth() {
			if (isset($_SESSION['user_id'])) return true;

			// проверяем наличие пользователя с указанным юзернеймом
			$userData = $this->input->get_post(null, TRUE);
			$sql = 'SELECT * FROM `users` WHERE `username` = '.$this->db->escape($userData['user']);
			$stmt = $this->db->query($sql);
			$user = $stmt->row();

			$this->userId = $user->id;
			$this->userName = $user->username;

			if (password_verify($userData['password'], $user->password)) {
				// Проверяем, не нужно ли использовать более новый алгоритм
				// или другую алгоритмическую стоимость
				// Например, если вы поменяете опции хеширования
				if (password_needs_rehash($userData['password'], PASSWORD_DEFAULT)) {
					$newHash = password_hash($userData['password'], PASSWORD_DEFAULT);
					$sql = 'UPDATE `users` SET `password` = '.$this->db->escape($newHash).' WHERE `username` = '.$this->db->escape($userData['user']);
					$this->db->query($sql);
				}

				$_SESSION['user_id'] = $user->id;
				$this->isAuth = true;

//				header("Location, ".$_SERVER['REQUEST_URI']);
				return true;
			} else {
//				echo '<br>'.__CLASS__.'$_SESSION user_id] = '.$_SESSION['user_id'];
				return false;
			}
		}


		function isAuth()
		{
//			return $_SESSION['user_id'];
			return !!($_SESSION['user_id'] ?? false);
		}




		public function register($user, $password) {
			// Добавим пользователя в базу
			$sql = 'INSERT INTO `users` (`username`, `password`) VALUES ("'.$this->db->escape_str($user).'", "'.$this->db->escape_str(password_hash("'.$password.'", PASSWORD_DEFAULT)).'")';
			var_dump($this->db->query($sql));
		}


	} // /class
