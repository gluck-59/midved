<?php

	/**
	 * модель заказчика
	 */
	class PaymentModel extends CI_Model
	{
		public $customers;

		function __construct()
		{
//			$stmt = $this->db->query('select * from customer');
//			$this->customers = $stmt->result();
		}


		public function getPaymentsByRequest(array $idRequest = null) : array {
//			if (!is_null($idRequest)) {
//				return new ErrorException('Отсутствует $idRequest в '.__FUNCTION__);
//			}

			$sql = "select * from payment WHERE id IN (implode(',', $idRequest))";
			$stmt = $this->db->query($sql);
			return $stmt->result();
		}


	}
