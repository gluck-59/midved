<?php

    /**
     * модель оборудования — станки, агрегаты итд
     * все, с чем производятся работы
     */
    class EquipmentModel  extends CI_Model
    {
        public $address;
        public $name;
        public $marka;

		public function getEquipment() {
			$sql = "select e.id, e.mark, e.name equipment_name, c.name customer_name from equipment e JOIN customer c ON c.id = e.customer_id";
			$stmt = $this->db->query($sql);

			foreach ($stmt->result_array() as $equipment) {
				$out[$equipment['id']] = (object) $equipment;
			}
			return $out;
		}




    }
