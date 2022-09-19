<?php

	/**
	 * модель заказчика
	 */
	class CustomerModel extends CI_Model
	{
		public $customers;

		function __construct()
		{
			$stmt = $this->db->query('select * from customer');
			$this->customers = $stmt->result();
		}


		public function getCustomers(array $idCustomers = null) : array {
			$where = 'WHERE 1 ';
			if (!is_null($idCustomers)) $where .= 'AND id IN('.implode(',', $idCustomers).')';
			$sql = "select * from customer $where";
			$stmt = $this->db->query($sql);
			return $stmt->result();
		}


	}
