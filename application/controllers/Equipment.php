<?php

	class Equipment extends CI_Controller
	{
		public $equipment;
		function __construct()
		{
			parent::__construct();
			$this->load->model('EquipmentModel');
		}

		public function index() {
			$this->equipment = $this->EquipmentModel->getEquipment();
//			prettyDump($this->request);
			$this->load->view('header');
			$this->load->view('equipment', ['customers' => $this->customer, 'equipments' => $this->equipment]);
			$this->load->view('footer');
		}
    }
