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
//			prettyDump($this->request);
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
		 * создает станок
		 * @return void
		 */
		public function create() {
			$equipmentData = $this->input->get_post(null, TRUE);
			$res = $this->EquipmentModel->create($equipmentData);
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
