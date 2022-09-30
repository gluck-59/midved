<?php

	class Equipment extends CI_Controller
	{
		public $equipment;
		function __construct()
		{
			parent::__construct();
			$this->load->model('EquipmentModel');
			$this->router->pageName = 'Оборудование';
		}

		public function index() {
			$this->equipment = $this->EquipmentModel->getEquipment();
			$this->load->view('header');
			$this->load->view('equipment', ['customers' => $this->customer, 'equipments' => $this->equipment]);
			$this->load->view('footer');
		}


		/**
		 * для аякса
		 * тянет станки, принадлежащие клиентам с уазанными ID
		 * возвращает json
		 * @param string $customerId
		 * @return string
		 */
		public function getEquipmentByCustomerId(string $customerId = '') {
			echo json_encode($this->EquipmentModel->getEquipment([$customerId]));
		}


		/**
		 * разбирает create или edit станка
		 * вызывает соотв методы
		 * @return void
		 */
		public function save() {
			$equipmentData = $this->input->get_post(null, TRUE);
			// это новый станок
			if ($equipmentData['customerField'] == '') {
				echo self::create($equipmentData);
			}
			// это старый станок
			else {
				echo self::edit($equipmentData);
			}
		}


		/**
		 * создает станок
		 * @return void
		 */
		public function create($equipmentData) {
			$res = $this->EquipmentModel->create($equipmentData);
			echo $res;
		}


		/**
		 * редактирует станок
		 * @return void
		 */
		public function edit($equipmentData) {
			$res = $this->EquipmentModel->edit($equipmentData);
			echo $res;
		}


		/**
		 * удаляет станок
		 * @return void
		 */
		public function delete() {
			$equipmentData = $this->input->get_post(null, TRUE);
			$res = $this->EquipmentModel->delete($equipmentData);
			echo $res;
		}
    }
