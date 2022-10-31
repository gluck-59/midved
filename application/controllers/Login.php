<?php

    /**
     * @var Login
     */
    class Login extends CI_Controller
    {
        public $userModel;
		public function __construct()
		{
			parent::__construct();
            $this->userModel = new UserModel();
		}


        public function index() {
			$loginData = $this->input->get_post(null, TRUE);
			if ($this->userModel->isAuth($loginData)) {
				header('Location: /welcome');
			}

		}
    }
