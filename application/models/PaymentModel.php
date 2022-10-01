<?php

	/**
	 * модель заказчика
	 */
	class PaymentModel extends CI_Model
	{

		public $id;
		public $request_id;
		public $type;
		public $sum;
		public $note;
		public $created;

		/**
		 * тянет историю затрат/платежей по номеру заявки
		 * @param int $reqestId
		 * @return array
		 */
		public function get(int $reqestId = null) : array {
			if (is_null($reqestId)) throw new Exception('Отсутствует номер заявки в '.__CLASS__.': '.__LINE__);
			$sql = "select  p.id, p.request_id, p.type, p.note, p.sum/100 as sum, /*DATE_FORMAT(p.created, '%m.%d.%Y') created*/p.created FROM  payment p WHERE p.request_id = $reqestId ORDER BY p.created ASC";
			$stmt = $this->db->query($sql);
			return $stmt->result();
		}


		/**
		 * платежи: создает приход-расход
		 * @param array $paymentData
		 * @return mixed
		 */
		public function set(array $paymentData) {
			if ($paymentData['direction'] == 0) $sum = -$paymentData['sum']; 	// расход
			elseif ($paymentData['direction'] == 1) $sum = $paymentData['sum'];	// приход

			// из-за необходимости записи NULL в $paymentData['note']
			// будем использовать builder
			$data = array(
				'request_id' => $paymentData['requestId'],
				'type' => $paymentData['type'],
				'sum' => $sum*100,
			);
			if (!empty($paymentData['note'])) {
				$data['note'] = $paymentData['note'];
			}

			return $this->db->insert('payment', $data);
		}


		/**
		 * редактирует приход-расход по ID
		 * @param int $paymentId
		 * @return int
		 */
		public function edit(array $paymentData) : int {
			$entity = $this->db->escape_str($paymentData['entity']);
			if ($entity == 'sum') {
				$value = $this->db->escape_str($paymentData['value']);
				$value = (int) $value*100;
			} else {
				$value = $this->db->escape($paymentData['value']);
			}
			$set = $entity.' = '.$value;

			$sql = 'UPDATE payment SET '.$set.' WHERE id = '.$paymentData['paymentId'];
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
