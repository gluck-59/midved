<?php

	class Request extends CI_Controller
	{
		private $payments;
		function __construct()
		{
			parent::__construct();
			$this->load->model('RequestModel');
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
    }
