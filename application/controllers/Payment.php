<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    /**
     * @var Payment
     */
class Payment extends CI_Controller {

    public $paymentModel;
	function __construct() {
		parent::__construct();
		$this->paymentModel = new PaymentModel();
		$this->router->pageName = 'Расчеты';
	}

	public function history($reqestId = null) : array {
		$this->request = $this->paymentModel->get($reqestId);
	}


	/**
	 * удаляет платеж
	 * @return void
	 */
	public function delete() {
		$paymentId = $this->input->get_post('id', TRUE);
		$res = $this->paymentModel->delete($paymentId);
		echo json_encode($res);
	}


	/**
	 * редактирует платеж
	 * @return void
	 */
	public function edit() {
		$paymentData = $this->input->get_post(null, TRUE);
		echo $this->paymentModel->edit($paymentData);
	}

}
