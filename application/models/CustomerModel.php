<?php

	/**
	 * модель заказчика
	 */
	class CustomerModel extends CI_Model
	{
		public $customers;

//		function __construct()
//		{
//			$stmt = $this->db->query('select * from customer');
//			$this->customers = $stmt->result();
//		}


		public function create(array $customerData) {
			$sql = 'INSERT INTO customer SET name = '.$this->db->escape($customerData['customerName']).', data = '.$this->db->escape($customerData['customerData']);
			$this->db->query($sql);
			return $this->db->insert_id();
		}


		public function get(array $idCustomers = null) : array {
			$where = 'WHERE 1 ';
			if (!is_null($idCustomers)) $where .= 'AND id IN('.implode(',', $idCustomers).')';
			$sql = "select * from customer $where";
			$stmt = $this->db->query($sql);
			return $stmt->result();
		}



		/**
		 * редактирует заказчика
		 * @param array $customerData
		 * @return mixed
		 */
		public function edit(array $customerData) {
			$sql = 'UPDATE customer SET 
			name = '.$this->db->escape($customerData['customerName']).', 
			data = '.$this->db->escape($customerData['customerData']).' 
			WHERE id = '.$this->db->escape_str($customerData['customerId']);
			return $this->db->query($sql);
		}





		/**
		 * удаляет клиента со всеми потрохами — станками, заявками, документами, платежами
		 * @param array $customerData
		 * @return mixed
		 */
		public function delete(array $customerData) {
			$sql = 'DELETE FROM customer WHERE id = '.$customerData['customerId'] ;
			return $this->db->query($sql);
		}

	}
