<?php

	class Request extends CI_Controller
	{
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
    }
