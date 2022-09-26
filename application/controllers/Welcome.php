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

		$this->router->pageName = 'Главная';
	}

	public function index()
	{
		$this->customer = $this->customerModel->get();
		$this->request = $this->RequestModel->getRequests();
		$this->equipment = $this->equipmentModel->getEquipment();

		$this->load->view('header');
		$this->load->view('main', ['customers' => $this->customer, 'requests' => $this->request, 'equipments' => $this->equipment]);
		$this->load->view('footer');
	}


	/**
	 * использование: https://ссайт/welcome/jopaRegiser/имя/пароль/
	 * @param $user
	 * @param $password
	 * @return void
	 */
	public function jopaRegiser($user, $password) {
		$this->userModel->register($user, $password);
	}

}
