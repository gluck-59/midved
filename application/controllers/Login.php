<?php

    class Login extends CI_Controller
    {
		public function __construct()
		{
			parent::__construct();
		}



        public function index() {
			$loginData = $this->input->get_post(null, TRUE);
			$user = new UserModel();
			if ($user->isAuth($loginData)) {
				header('Location: /welcome');
			}

		}




        public function loginPage() {
			$this->load->view('login');
		}


    }
