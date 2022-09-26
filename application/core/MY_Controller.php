<?php

    class MY_Controller extends CI_Controller
    {
		public function __construct()
		{
			parent::__construct();
			var_dump(__CLASS__);
		}


		public function index() {
			var_dump(__CLASS__);
		}

		public function Myfunction() {
			var_dump(__CLASS__);
		}
	}
