<?php

    /**
     * @var CustomerModel
     */
	class CustomerModel extends CI_Model
	{
		public $id;
		public $name;
		public $data;
        public $currentUser;

		function __construct()
		{
            $userModel = new UserModel();
            $this->currentUser = $userModel->getCurrentUser();
		}


		/**
		 * создает заказчика
		 * @param array $customerData
		 * @return int
		 */
		public function createOLD(array $customerData) : int {
			$sql = 'INSERT INTO customer SET name = '.$this->db->escape($customerData['customerName']).', parentId = '.$this->db->escape($customerData['parentId']).', data = '.$this->db->escape($customerData['customerData']);
			$this->db->query($sql);
			return $this->db->insert_id();
		}

        public function create(array $customerData) : int {
            $data = array(
                'creator' => $this->currentUser->id,
                'name' => $this->db->escape_str($customerData['customerName']),
                'data' => $this->db->escape_str($customerData['customerData']),
            );
            if (!empty($customerData['parentId'])) {
                $data['parentId'] = $this->db->escape_str($customerData['parentId']);
            }
            $this->db->insert('customer', $data);
            return $this->db->insert_id();
		}


		/**
		 * тянет данные клиентов по ID клиента и по ID создателя
		 * если оба ID не определены, тянет данные обо всех
		 * @param array|null $idCustomers
		 * @return mixed
		 */
		public function get(array $idCustomers = null) {
			$where = 'WHERE 1';
            if (!is_null($this->currentUser->id)) $where = 'WHERE creator = '.$this->currentUser->id;
			if (!is_null($idCustomers)) $where .= 'AND id IN('.implode(',', $idCustomers).')';
            $sql = "SELECT * FROM customer ".$where;
			$query = $this->db->query($sql);
            $allCustomers = $query->result();

            $customers = ['parents' => [], 'childs' => []];
            foreach ($allCustomers as $customer) {
                if (is_null($customer->parentId)) $customers['parents'][] = $customer;
                else $customers['childs'][] = $customer;
            }

			return $customers;
		}



		/**
		 * редактирует заказчика
		 * @param array $customerData
		 * @return int
		 */
		public function edit(array $customerData) : int {
            $additional = ', parentId = NULL';
            if (!empty($customerData['parentId'])) {
                $additional = ', parentId = '.$this->db->escape($customerData['parentId']);
            }
			$sql = 'UPDATE customer SET 
			name = '.$this->db->escape($customerData['customerName']).$additional.', 
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
