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
	}


	/**
	 * удаляет платеж
	 * @return void
	 */
	public function delete() {
		$this->payments = $this->load->model('PaymentModel');
		$paymentId = $this->input->get_post('id', TRUE);
		$res = $this->PaymentModel->delete($paymentId);
		echo json_encode($res);
	}


	/**
	 * редактирует платеж
	 * @return void
	 */
	public function edit() {
		$this->load->model('PaymentModel');
		$paymentData = $this->input->get_post(null, TRUE);
		echo $this->PaymentModel->edit($paymentData);
	}

}
