<?php

    class Login extends CI_Controller
    {
		public function __construct()
		{
			parent::__construct();
		}



        public function index() {
			$loginData = $this->input->get_post(null, TRUE);
			if (!empty($loginData['user'])) {
				header('Location: /welcome');
			}

		}




        public function loginPage() {
			$this->load->view('login');
		}


    }
