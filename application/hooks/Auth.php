<?php
	class Auth {

		public function doAuth($loginData) {
			$user = new UserModel();
			if ( $user->isAuth($loginData) )
			{
				return true;
			} else {
				session_destroy();
				header('Location: /login.php');
				return false;
			}
		}





	}
