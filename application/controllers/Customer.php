<?php

	class Customer extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('CustomerModel');

		}

		public function index() {
//prettyDump($this->CustomerModel->customers);
			$this->load->view('header');
			$this->load->view('customer', ['customers' => $this->CustomerModel->customers]);
			$this->load->view('footer');
		}


		/**
		 * для аякса
		 * тянет всю инфу обо всех клиентах
		 * @return string
		 */
		public function getAll() {
			echo json_encode($this->CustomerModel->customers, JSON_NUMERIC_CHECK);
		}
    }
