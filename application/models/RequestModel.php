<?php

	/**
	 * заявки на работы Work
	 */
	class RequestModel extends CI_Model
	{
//		function __construct() {
//
//		}

		public function index() {
			return __FILE__;
		}

		public function getRequests(array $idRequests = null) : array {
			$where = 'WHERE 1 ';
			if (!is_null($idRequests)) $where .= 'AND id IN('.implode(',', $idRequests).')';
			$sql = "select r.id, r.name, r.status, r.created, r.updated, r.price, e.name equipment, e.mark, c.name customer from request r
			JOIN equipment e ON e.id = r.equipment_id
			JOIN customer c ON c.id = e.customer_id
			$where";
			$stmt = $this->db->query($sql);
			return $stmt->result();
		}
	}
