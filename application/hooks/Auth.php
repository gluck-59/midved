<?php
	class Auth {

		public function doAuth() {
			$user = new UserModel();
//			if (!is_null($user->isAuth()))
			if ( $user->isAuth() )
			{
//				var_dump($_SESSION);
//				header('Location: /welcome');
				return true;
			} else {
				session_destroy();
//				$this->load->view('login');
				header('Location: login.php');
				return false;
			}
		}





	}
