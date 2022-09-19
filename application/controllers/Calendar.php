<?php

    class Calendar extends CI_Controller
    {


		public function index() {
			$this->load->view('header');
			$this->load->view('calendar');
			$this->load->view('footer');

		}
    }
