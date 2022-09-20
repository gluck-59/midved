<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('PaymentModel');
		$this->router->pageName = 'Расчеты';
	}

	public function history($reqestId = null) : array {
		$this->request = $this->PaymentModel->history($reqestId);
//			prettyDump($this->request);
//		$this->load->view('header');
//		$this->load->view('request', ['customers' => $this->customer, 'requests' => $this->request, 'equipments' => $this->equipment]);
//		$this->load->view('footer');
	}

}
