<?php

//namespace application\controllers\Request;
//use RequestModel;

	class Request extends CI_Controller
	{
		public $request;
		public $payments;
		public $requestModel;
        public $paymentModel;

		function __construct()
		{
			parent::__construct();
            $this->requestModel = new RequestModel();
            $this->paymentModel = new PaymentModel();
			$this->router->pageName = 'Заявки';
		}


        /**
         * тянет все заявки
         *
         * @param $json //формат выхода, нужен для запроса аяксом
         * @return void
         */
		public function index($json = false) {
            if ($json) {
                echo json_encode($this->requestModel->getRequests());
            } else {
                $this->load->view('header');
                $this->load->view('request', ['customers' => $this->customer, 'requests' => $this->requestModel->getRequests(), 'equipments' => $this->equipment]);
                $this->load->view('footer');
            }
		}


		/**
		 * редактирование заявки
		 * @param int|null $requestId
		 * @return void
		 */
		public function edit(int $requestId = null) {
			$this->load->view('header');
			$this->load->view('requestEdit', ['request' => $this->requestModel->edit($requestId), 'payments' => $this->paymentModel->get($requestId)]);
			$this->load->view('footer');
		}


		/**
		 * пишет приход-расход в заявку № ID
         * авторазноска платежей здесь же
		 * @return void
		 */
		public function payment() {
			$paymentData = $this->input->get_post(null, TRUE);

            // если customerId не передан — это обычный платеж
            if (empty($paymentData['customerId']) AND !empty($paymentData['requestId'])) {
			    $res = $this->paymentModel->set($paymentData);
            }
            // если requestId не передан — это авторазноска
            elseif (empty($paymentData['requestId']) AND !empty($paymentData['customerId'])) {
                $res = $this->paymentModel->autoDistribution($paymentData);
            }
//prettyDump($res);
//prettyDump(json_encode($res), 1);
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
            if ($this->requestModel->setNotes($data)) {
                $type = 1;
                $message = 'Заметка успешно изменена';
            } else {
                $type = 0;
                $header = 'Не удалось сохранить заметку';
                $message = 'Перезагрузите страницу и попробуйте снова';
            }
            echo json_encode(['toastr' => toToastr::send($type, $message,  $header)]);
		}


		/**
		 * пишет новый статус заявки
		 * @return void
		 */
		public function setStatus() {
			$data = $this->input->get_post(null, TRUE);
            if ($this->requestModel->setStatus($data)) {
                $type = 1;
                $message = 'Статус изменен';
            } else {
                $type = 0;
                $header = 'Не удалось изменить статус';
                $message = 'Перезагрузите страницу и попробуйте снова';
            }
            echo json_encode(['toastr' => toToastr::send($type, $message,  $header)]);
		}
    }
