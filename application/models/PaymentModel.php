<?php

	/**
	 * модель заказчика
	 */
	class PaymentModel extends CI_Model
	{
//		public $id;
//		public $requestId;
//		public $type;
//		public $sum;
//		public $note;

//		function __construct()
//		{
//			$stmt = $this->db->query('select * from customer');
//			$this->customers = $stmt->result();
//		}


		/**
		 * тянет историю затрат/платежей по номеру заявки
		 * @param int $reqestId
		 * @return array
		 */
		public function history(int $reqestId = null) : array {
			if (is_null($reqestId)) throw new Exception('Отсутствует номер заявки в '.__CLASS__.': '.__LINE__);
			$sql = "select  p.id, p.request_id, p.type, p.note, p.sum/100 as sum, DATE_FORMAT(p.created, '%m.%d.%Y') created FROM  payment p WHERE p.request_id = $reqestId ORDER BY p.created ASC";
			$stmt = $this->db->query($sql);
			return $stmt->result();
		}


		/**
		 * платеж: приход-расход
		 * @param array $paymentData
		 * @return mixed
		 */
		public function payment(array $paymentData) {
			if ($paymentData['direction'] == 0) $sum = -$paymentData['sum']; 	// расход
			elseif ($paymentData['direction'] == 1) $sum = $paymentData['sum'];	// приход

			$sql = 'INSERT INTO payment (request_id, type, sum, note) VALUES ('.(int) $paymentData['requestId'].', '.(int) $paymentData['type'].', '.$sum*100 .', '.$this->db->escape($paymentData['note']).')';
			return  $this->db->query($sql);
		}


		/**
		 * удаляет приход-расход по ID
		 * @param int $paymentId
		 * @return bool
		 */
		public function delete(int $paymentId) : bool {
			$sql = 'DELETE FROM payment WHERE id = '.$paymentId;
			return  $this->db->query($sql);
		}

	}
