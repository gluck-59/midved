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
		echo ENVIRONMENT;
//		$this->load->model('customerModel');
//		$this->load->model('RequestModel');
//		$this->load->model('equipmentModel');
//		$this->load->model('userModel');
		$this->router->pageName = 'Главная';



//		$userlogged = $this->userModel->isAuth();
////		var_dump(($userlogged));
//		if (!empty($userlogged)) {
//			return self::getmain();
//		} else {
//			return self::login();
//		}
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
