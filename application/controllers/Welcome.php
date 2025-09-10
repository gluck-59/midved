<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Welcome extends CI_Controller
    {
        public $customer;
        public $request;
        public $equipment;
        public $customerModel;
        public $equipmentModel;
        public $requestModel;

        function __construct()
        {
            parent::__construct();
            $this->router->pageName = 'Главная';
            $this->customerModel = new CustomerModel();
            $this->equipmentModel = new EquipmentModel();
            $this->requestModel = new RequestModel();
        }

        public function index()
        {
            $this->customer = $this->customerModel->get();
            $this->equipment = $this->equipmentModel->getEquipment();
            $this->request = $this->requestModel->getRequests();

            if (empty($this->customer['parents'])) {
                header('Location: /customer');
            } elseif (empty($this->equipment)) {
                header('Location: /equipment');
            } elseif (empty($this->request)) {
                header('Location: /request');
            } else {
                $this->load->view('header');
                $this->load->view('main', ['customers' => $this->customer, 'requests' => $this->request, 'equipments' => $this->equipment]);
                $this->load->view('footer');
            }
        }


        /**
         * использование: https://ссайт/welcome/reGisTer/имя/пароль/
         *
         * @param $user
         * @param $password
         * @return void
         */
        public function reGisTer($user, $password)
        {
            echo($this->userModel->register($user, $password) ? 'TRUE' : 'FALSE');
        }

    }
