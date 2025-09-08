<?php

    /**
     * @var UserModel
     *
     * модель пользователя системы
     * @TODO добавить роли
     */
    class UserModel extends CI_Model
    {
		public $id;
		public $name;
        public $currentUser;

		public function __construct()
		{
			parent::__construct();
			self::auth();
		}


		public function auth() {
			if ($_SESSION['user_id'] > 0) return true;

			$userData = $this->input->get_post(null, TRUE);
			$sql = 'SELECT * FROM `users` WHERE `username` = '.$this->db->escape($userData['user']);
			$stmt = $this->db->query($sql);
			$user = $stmt->row();
			$this->id = $user->id;
			$this->name = $user->username;

			if (password_verify($userData['password'], $user->password)) {
				// Проверяем, не нужно ли использовать более новый алгоритм или другую алгоритмическую стоимость
				// Например, если вы поменяете опции хеширования
				if (password_needs_rehash($userData['password'], PASSWORD_DEFAULT)) {
					$newHash = password_hash($userData['password'], PASSWORD_DEFAULT);
					$sql = 'UPDATE `users` SET `password` = '.$this->db->escape($newHash).' WHERE `username` = '.$this->db->escape($userData['user']);
					$this->db->query($sql);
				}

				$_SESSION['user_id'] = $user->id;
			} else {
				$_SESSION['user_id'] = 0;
			}
		}


		function isAuth($loginData) {
			return !!($_SESSION['user_id'] ?? self::auth($loginData));
		}



		public function register($user, $password) {
			$sql = 'INSERT INTO `users` (`username`, `password`) VALUES ("'.$this->db->escape_str($user).'", "'.password_hash($password, PASSWORD_DEFAULT).'")';
			return $this->db->query($sql);
		}

        public function getCurrentUser() {
            return self::_getUser($_SESSION['user_id']);
        }

        private function _getUser($userId = null) {
            if (is_null($userId)) return [];

            $sql = 'SELECT id, username FROM `users` WHERE `id` = '.$this->db->escape($userId);
            $stmt = $this->db->query($sql);
            $user = $stmt->row();
            return $user;
        }


	} // /class
