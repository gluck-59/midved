<?php

    /**
     * модель оборудования — станки, агрегаты итд
     * все, с чем производятся работы
     */
    class EquipmentModel  extends CI_Model
    {
		public $equipments;
        public $city;
        public $address;
        public $name;
        public $marka;



		function __construct()
		{
			$stmt = $this->db->query('select * from equipment');
			$this->customers = $stmt->result();
		}




		public function getEquipment(array $customerIds = []) : array
		{
			$where = 'WHERE 1 ';
			if (!empty($customerIds)) $where .= 'AND c.id IN('.implode(',', $customerIds).')';
			$sql = "select e.id, e.customer_id, e.name, e.mark, e.city, e.address, c.name customer from equipment e JOIN customer c ON c.id = e.customer_id $where";
			$stmt = $this->db->query($sql);
			return $stmt->result();
		}


		/**
		 * создаёт станок
		 * @param array $equipmentData
		 * @return mixed
		 */
		public function create(array $equipmentData) {
 			$sql = 'INSERT INTO equipment SET 
				customer_id = '.$this->db->escape_str($equipmentData['owner']).', 
				name = '.$this->db->escape($equipmentData['name']).', 
				mark = '.$this->db->escape($equipmentData['mark']).', 
				address = '.$this->db->escape($equipmentData['address']).', 
				city = '.$this->db->escape($equipmentData['city']);
			$this->db->query($sql);
			return $this->db->insert_id();
		}


		/**
		 * удаляет станок
		 * @param array $equipmentData
		 * @return mixed
		 */
		public function delete(array $equipmentData) {
 			$sql = 'DELETE FROM equipment WHERE id = '.$this->db->escape($equipmentData['equipmentId']);
			return $this->db->query($sql);
		}

   }
