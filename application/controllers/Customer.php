<?php

    /**
     * @var Customer
     */
	class Customer extends CI_Controller
	{
        public $customerModel;
		function __construct()
		{
			parent::__construct();
			$this->customerModel = new CustomerModel();
			$this->router->pageName = 'Клиенты';
		}

		public function index() {
			$this->load->view('header');
			$this->load->view('customer', ['customers' => $this->customerModel->get()]);
			$this->load->view('footer');
		}


		/**
		 * для аякса
		 * тянет всю инфу обо всех клиентах
		 * @return string
		 */
		public function getAll() {
			echo json_encode($this->customerModel->get(), JSON_NUMERIC_CHECK);
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
				echo $this->customerModel->create($customerData);
			}
			// это старый
			else {
				echo $this->customerModel->edit($customerData);
			}


		}


		/**
		 * создает клиента
		 * @return void
		 */
		public function create() {
			die('create customer ?');
			$customerData = $this->input->get_post(null, TRUE);
			$res = $this->customerModel->create($customerData);
			echo $res;
		}



		/**
		 * удаляет клиента
		 * @return void
		 */
		public function delete() {
			$customerData = $this->input->get_post(null, TRUE);
			$res = $this->customerModel->delete($customerData);
			echo $res;
		}
    }
