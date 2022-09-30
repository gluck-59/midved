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

				// недопустимые слова в запросах
				$re = ['delete', 'drop', 'alter', 'shutdown', 'grant', 'execute', 'super'];
				$matches = [];

 				if ((strpos(mb_strtolower($sql['sql']),'select') == 0 AND strpos(mb_strtolower($sql['sql']),'select') !== false) AND !preg_match_all('/'.implode("|", $re).'/mi', $sql['sql'], $matches)) {
					$result = self::execRequest($sql['sql']);
				} //else $matches = //$result = implode(', ', $matches[0]).' — низзя';
			} else {
					$sql['sql'] = '
SELECT r.name, p.sum/100
, COALESCE(p.note, IF(p.type = 1, "работа", "неработа")) as note
, DATE_FORMAT(p.created, "%d.%m.%Y") as date
FROM payment as p
JOIN request r ON r.id = p.request_id

/* ЭТО ОБОРЗЕЦ */';
			}

			$this->load->view('header');
			$this->load->view('report', ['request' => $sql, 'result' => $result, 'stopWords' => $matches]);
			$this->load->view('footer');
		}



		public function execRequest($sql) {
			return ($this->ReportModel->execRequest($sql));
		}

	}
