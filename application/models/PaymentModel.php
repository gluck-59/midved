<?php

	/**
	 * модель заказчика
	 */
	class PaymentModel extends CI_Model
	{
//		public $payment;

		function __construct()
		{
//			$stmt = $this->db->query('select * from customer');
//			$this->customers = $stmt->result();
		}


		/**
		 * тянет историю затрат/платежей по номеру заявки
		 * @param int $reqestId
		 * @return array
		 */
		public function history(int $reqestId = null) : array {
			if (is_null($reqestId)) throw new Exception('Отсутствует номер заявки в '.__CLASS__.': '.__LINE__);
			$sql = "select  p.id, p.request_id, p.type, p.sum/100 as sum, DATE_FORMAT(p.created, '%m.%d.%Y') created FROM  payment p WHERE p.request_id = $reqestId ORDER BY p.created ASC";
			$stmt = $this->db->query($sql);
			return $stmt->result();
		}


	}
