<?php

    /**
     * @var ReportModel
     *
     * модель отчетов
     */

    class ReportModel extends CI_Model
    {
        public $currentUser;
		public function __construct()
		{
            $userModel = new UserModel();
            $this->currentUser = $userModel->getCurrentUser();
		}


        /**
         * выполняет присланный юзером SQL запрос
         * запрос предварительно очищенный в контроллере
         *
         * @param $sql
         * @return mixed
         */
		public function execRequest($sql) {
			$stmt = $this->db->query($sql);
			return $stmt->result_array();
		}


        /**
         * дебиторская задолженность
         * @return mixed
         */
        public function debitorka() {
            $sql = "SELECT r.id requestId, r.name request, DATE_FORMAT(r.created, '%d.%m.%Y') created, e.name equipment, e.mark, e.city, c.id customerId, c.parentId, c.name customer
,(SELECT SUM(p.sum) FROM payment p WHERE p.request_id = r.id)/100 as sum 
FROM request r 

JOIN equipment e ON e.id = r.equipment_id 
JOIN customer c ON c.id = e.customer_id AND c.creator = ".$this->currentUser->id." 

WHERE (SELECT SUM(p.sum) FROM payment p WHERE p.request_id = r.id) < 0

GROUP BY customerId, requestId
ORDER BY sum, r.created DESC ";
            $stmt = $this->db->query($sql);
            return $stmt->result_array();
        }


        /**
         * всего оплачено
         *
         * @return array
         */
        public function totalPayed() {
            $sql = "SELECT r.id requestId, r.name request, DATE_FORMAT(r.created, '%d.%m.%Y') created, e.name equipment, e.mark, e.city, c.id customerId, c.parentId, c.name customer
,(SELECT SUM(p.sum) FROM payment p WHERE p.request_id = r.id AND p.sum > 0)/100 as sum 

FROM request r 

JOIN equipment e ON e.id = r.equipment_id 
JOIN customer c ON c.id = e.customer_id
JOIN payment p ON p.request_id = r.id

WHERE c.creator = ".$this->currentUser->id." AND r.status <> 2
and p.sum > 0

GROUP BY customerId
ORDER BY p.created DESC";
//prettyDump($sql);
            $stmt = $this->db->query($sql);
            return $stmt->result_array();
        }


		public function salaryByMonth() {
            $this->db->query("SET lc_time_names='ru_RU'");
            $sql = "SELECT SUM(p.sum)/100 sum, MONTHNAME(p.created) monthh, YEAR(p.created) yearr
FROM payment p

JOIN request r ON r.id = p.request_id
JOIN equipment e ON e.id = r.equipment_id 
JOIN customer c ON c.id = e.customer_id AND c.creator = ".$this->currentUser->id." 

GROUP BY monthh, yearr";
//prettyDump($sql);
            $stmt = $this->db->query($sql);
            return $stmt->result_array();
        }



        /*
имена стоблцов получать так
SELECT `TABLE_NAME`, `COLUMN_NAME`
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA`='medved'
AND `TABLE_NAME`in ('payment', 'request')
*/

    } // /class
