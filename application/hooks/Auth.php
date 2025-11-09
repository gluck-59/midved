<?php
	class Auth {

		public function doAuth($loginData) {
			$CI = &get_instance();
			$controller = strtolower($CI->router->class ?? '');
			$publicControllers = ['docs'];
			if (in_array($controller, $publicControllers, true)) {
				return true;
			}

			$user = new UserModel();
			if ($user->isAuth($loginData)) {
				return true;
			} else {
				session_destroy();
				header('Location: /login.php'); // ?wrongpassword
				return false;
			}
		}



	}
