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
			$sql = "select r.id, r.name, r.status, r.notes, DATE_FORMAT(r.created, '%d.%m.%y') created, DATE_FORMAT(r.updated, '%d.%m.%y') updated, 
       		e.name equipment, e.city, e.address, e.mark, e.serial, 
       		c.name customer
     		,(SELECT SUM(p.sum) FROM payment p WHERE p.request_id = r.id)/100 as sum 
			from request r 
			JOIN equipment e ON e.id = r.equipment_id 
			JOIN customer c ON c.id = e.customer_id $where ORDER BY r.status, r.updated DESC";
			$stmt = $this->db->query($sql);
			return $stmt->result();
		}



		/**
		 * редактирование заявки
		 * @param int|null $requestId
		 * @return object
		 */
		public function edit(int $requestId = null) : object {
			$sql = "select DISTINCT r.id, r.equipment_id, r.name, r.status, r.notes, e.notes equipment_notes, e.serial, DATE_FORMAT(r.created, '%d.%m.%Y') created, DATE_FORMAT(r.updated, '%d.%m.%Y') updated
			,(SELECT SUM(p.sum) FROM payment p WHERE p.request_id = r.id)/100 as sum, 
			e.name equipment, e.mark, e.city, e.address, c.name customer_name
			FROM  request r 
			LEFT JOIN payment p ON p.request_id = r.id
			JOIN equipment e ON e.id = r.equipment_id
			JOIN customer c ON c.id = e.customer_id
			WHERE r.id = $requestId";
			$stmt = $this->db->query($sql);
			$res = $stmt->row();
			return $res;
		}

		/**
		 * создает новую заявку
		 * возвращает ее номер
		 * @param array $requestData
		 * @return int
		 */
		public function create(array $requestData) : int {
			$sql = 'INSERT INTO request (equipment_id, name) VALUES ('.(int) $requestData['equipments'].', '.$this->db->escape($requestData['desc']).' )';
			return  $this->db->query($sql);
		}



		/**
		 * пишет заметку
		 * @param array $requestData
		 * @return int
		 */
		public function setNotes(array $requestData) : int {
			$sql = 'UPDATE request SET notes = '.$this->db->escape($requestData['notes']).' WHERE id = '.$requestData['requestId'];
			return  $this->db->query($sql);
		}


		public function setStatus($statusData)
		{
			$sql = 'UPDATE request SET status = '.$this->db->escape($statusData['statusId']).' WHERE id = '.$statusData['requestId'];
			return  $this->db->query($sql);
		}
	}
