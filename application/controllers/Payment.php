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

    /** @deprecated */
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
        if ($this->paymentModel->edit($paymentData)) {
            $type = 1;
            $message = 'Платеж отредактирован';
        } else {
            $type = 0;
            $header = 'Не удалось отредактировать платеж';
            $message = 'Перезагрузите страницу и попробуйте снова';
        }
        echo json_encode(['toastr' => toToastr::send($type, $message,  $header)]);
	}

}
