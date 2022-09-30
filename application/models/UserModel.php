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

			$userData = $this->input->get_post(null, TRUE);
			$sql = 'SELECT * FROM `users` WHERE `username` = '.$this->db->escape($userData['user']);
			$stmt = $this->db->query($sql);
			$user = $stmt->row();
			$this->userId = $user->id;
			$this->userName = $user->username;

			$_SESSION['user_id'] = $user->id;

			if (password_verify($userData['password'], $user->password)) {
				// Проверяем, не нужно ли использовать более новый алгоритм или другую алгоритмическую стоимость
				// Например, если вы поменяете опции хеширования
				if (password_needs_rehash($userData['password'], PASSWORD_DEFAULT)) {
					$newHash = password_hash($userData['password'], PASSWORD_DEFAULT);
					$sql = 'UPDATE `users` SET `password` = '.$this->db->escape($newHash).' WHERE `username` = '.$this->db->escape($userData['user']);
					$this->db->query($sql);
				}

				$_SESSION['user_id'] = $user->id;
				$this->isAuth = true;
			} else {
				session_destroy();
				$this->isAuth = true;
			}
			return $this->isAuth;
		}


		function isAuth()
		{
			return !!($_SESSION['user_id'] ?? self::auth());
		}



		public function register($user, $password) {
			$sql = 'INSERT INTO `users` (`username`, `password`) VALUES ("'.$this->db->escape_str($user).'", "'.password_hash($password, PASSWORD_DEFAULT).'")';
			return $this->db->query($sql);
		}


	} // /class
