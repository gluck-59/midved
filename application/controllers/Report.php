<?php

    class Report extends CI_Controller
    {

		public function __construct()
		{
			parent::__construct();
			$this->router->pageName = 'Отчеты';
		}



		public function index() {
			if ($_POST) {
				$sql = $this->input->get_post(null, TRUE);

 				if (strpos(mb_strtolower($sql['sql']),'select') == 0 AND strpos(mb_strtolower($sql['sql']),'select') !== false) {
					$result = self::execRequest($sql['sql']);
				} else $result = 'низзя';
			} else {
					$sql['sql'] = '
SELECT r.name, p.sum/100
, COALESCE(p.note, IF(p.type = 1, "работа", "неработа")) as note
, DATE_FORMAT(p.created, "%d.%m.%Y") as date
FROM payment as p
JOIN request r ON r.id = p.request_id

/* ЭТО ОБОРЗЕЦ */';
			}

/* оборзец
SELECT sum
, IF (s.type=1, 'работа', 'неработа')
, DATE_FORMAT(s.created, '%d.%m.%Y')
FROM payment as s
*/
			$this->load->view('header');
			$this->load->view('report', ['request' => $sql, 'result' => $result]);
			$this->load->view('footer');
		}



		public function execRequest($sql) {
			return ($this->ReportModel->execRequest($sql));
		}

	}
