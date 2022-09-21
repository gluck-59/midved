<?php

	class Request extends CI_Controller
	{
		const STATUS_NEW = 0;
		const STATUS_WORK = 1;
		const STATUS_DONE = 2;
		public $payments;
		function __construct()
		{
			parent::__construct();
			$this->load->model('RequestModel');
			$this->router->pageName = 'Заявки';

		}

		public function index() {
			$this->request = $this->RequestModel->getRequests();
//			prettyDump($this->request);
			$this->load->view('header');
			$this->load->view('request', ['customers' => $this->customer, 'requests' => $this->request, 'equipments' => $this->equipment]);
			$this->load->view('footer');
		}


		/**
		 * редактирование заявки
		 * @param int|null $requestId
		 * @return void
		 */
		public function edit(int $requestId = null) {
			$this->payments = $this->load->model('PaymentModel');
//			$payment = $this->->history($requestId);?

			$this->load->view('header');
			$this->load->view('requestEdit', ['request' => $this->RequestModel->edit($requestId), 'payments' => $this->PaymentModel->history($requestId)]);
			$this->load->view('footer');
		}


		/**
		 * пишет приход-расход в заявку № ID
		 * @return void
		 */
		public function payment() {
			$this->payments = $this->load->model('PaymentModel');
			$paymentData = $this->input->get_post(null, TRUE);

			$res = $this->PaymentModel->payment($paymentData);
			echo json_encode($res);
		}


		/**
		 * создает заявку
		 * @return void
		 */
		public function create() {
			$data = $this->input->get_post(null, TRUE);
			echo $this->RequestModel->create($data);
		}




		public function setNotes() {
			$data = $this->input->get_post(null, TRUE);
			echo $this->RequestModel->setNotes($data);
		}
    }
