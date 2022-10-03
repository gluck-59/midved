<?php

//namespace application\controllers\Request;
//use RequestModel;

	class Request extends CI_Controller
	{
		const STATUSES = ['Новая', 'В работе', 'Готово'];

		public $request;
		public $payments;
//		public $requestModel;

		function __construct()
		{
			parent::__construct();
//            $this->load->model('requestModel');
			$this->router->pageName = 'Заявки';

		}

		public function index() {
//  если включать этот способ то надо закомментить лоад модели в конструкторе
//            $r = new \RequestModel();
//			$this->request = $r->getRequests();

            $this->request = $this->requestModel->getRequests();
			$this->load->view('header');
			$this->load->view('request', ['customers' => $this->customer, 'requests' => $this->request, 'equipments' => $this->equipment]);
			$this->load->view('footer');
		}


		/**
		 * @return void
		 */
		public function getAll()
		{
			echo json_encode($this->requestModel->getRequests());
		}


		/**
		 * редактирование заявки
		 * @param int|null $requestId
		 * @return void
		 */
		public function edit(int $requestId = null) {
			$this->payments = $this->load->model('PaymentModel');

			$this->load->view('header');
			$this->load->view('requestEdit', ['request' => $this->requestModel->edit($requestId), 'payments' => $this->PaymentModel->get($requestId)]);
			$this->load->view('footer');
		}


		/**
		 * пишет приход-расход в заявку № ID
		 * @return void
		 */
		public function payment() {
			$this->payments = $this->load->model('PaymentModel');
			$paymentData = $this->input->get_post(null, TRUE);

			$res = $this->PaymentModel->set($paymentData);
			echo json_encode($res);
		}


		/**
		 * создает заявку
		 * @return void
		 */
		public function create() {
			$data = $this->input->get_post(null, TRUE);
			echo $this->requestModel->create($data);
		}


		/**
		 * пишет заметку
		 * @return void
		 */
		public function setNotes() {
			$data = $this->input->get_post(null, TRUE);
			echo $this->requestModel->setNotes($data);
		}


		/**
		 * пишет новый статус заявки
		 * @return void
		 */
		public function setStatus() {
			$data = $this->input->get_post(null, TRUE);
			echo $this->requestModel->setStatus($data);
		}
    }
