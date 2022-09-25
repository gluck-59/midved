<?php

    class Login extends CI_Controller
    {
		public function __construct()
		{
			parent::__construct();
			$this->load->model('UserModel');
		}


        public function index() {
			$user = new UserModel();
			if (!is_null($user->isAuth())) {
				header('Location: /welcome');
			} else {
				$this->load->view('login');
			}
		}
    }
