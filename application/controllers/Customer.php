<?php

	class Customer extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('CustomerModel');
			$this->router->pageName = 'Клиенты';
		}

		public function index() {
//prettyDump($this->CustomerModel->customers);
			$this->load->view('header');
			$this->load->view('customer', ['customers' => $this->CustomerModel->get()]);
			$this->load->view('footer');
		}


		/**
		 * для аякса
		 * тянет всю инфу обо всех клиентах
		 * @return string
		 */
		public function getAll() {
			echo json_encode($this->CustomerModel->get(), JSON_NUMERIC_CHECK);
		}


		/**
		 * создает или редактирует клиента
		 * разбирает что надо сделать
		 * @return void
		 */
		public function save() {
			$customerData = $this->input->get_post(null, TRUE);
			// это новый
			if ($customerData['customerId'] == '') {
				echo $this->CustomerModel->create($customerData);
			}
			// это старый
			else {
				echo $this->CustomerModel->edit($customerData);
			}


		}


		/**
		 * создает клиента
		 * @return void
		 */
		public function create() {
			die('create customer ?');
			$customerData = $this->input->get_post(null, TRUE);
			$res = $this->CustomerModel->create($customerData);
			echo $res;
		}



		/**
		 * удаляет клиента
		 * @return void
		 */
		public function delete() {
			$customerData = $this->input->get_post(null, TRUE);
			$res = $this->CustomerModel->delete($customerData);
			echo $res;
		}
    }
