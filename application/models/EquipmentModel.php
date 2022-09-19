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
			$sql = "select e.id, e.name, e.mark, e.city, e.address, c.name customer from equipment e JOIN customer c ON c.id = e.customer_id $where";
			$stmt = $this->db->query($sql);
			return $stmt->result();
		}


   }
