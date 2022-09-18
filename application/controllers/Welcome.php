<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR);
//ini_set('display_errors', 1);

class Welcome extends CI_Controller
{
	private $url;
	public $customer;
	public $request;
	public $equipment;

	function __construct()
	{
		parent::__construct();
//		echo ENVIRONMENT;
/*
		$this->url = 'index';
		if (isset($_SERVER['PATH_INFO'])) {
			$temp = explode("/", $_SERVER['PATH_INFO']);
			$this->url = end($temp);
		}
		var_dump($this->url);
	*/
		$this->load->model('customerModel');
		$this->load->model('RequestModel');
		$this->load->model('equipmentModel');
	}

	public function index()
	{
		$this->customer = $this->customerModel->getCustomers();
		$this->request = $this->RequestModel->getRequests();
		$this->equipment = $this->equipmentModel->getEquipment();

//prettyDump($this->request);

		$this->load->view('header');
		$this->load->view('main', ['customers' => $this->customer, 'requests' => $this->request, 'equipments' => $this->equipment]);
		$this->load->view('footer');
	}

//	public function request()
//	{
//		$this->request = $this->request->getRequests();
//		$this->load->view('header');
//		$this->load->view('request', ['request' => $this->request]);
//		$this->load->view('footer');
//	}

	public function two()
	{
		$this->load->view('header');
		$this->load->view('two', ['page' => __FUNCTION__]);
		$this->load->view('footer');
	}


}
