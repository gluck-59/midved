<?php

    /**
     * @var ReportModel
     *
     * модель отчетов
     */

    class ReportModel extends CI_Model
    {
		public function __construct()
		{

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



        public function debitorka() {
            $sql = "SELECT r.id requestId, r.name request, DATE_FORMAT(r.created, '%d.%m.%Y') created, e.name equipment, e.mark, e.city, c.id customerId, c.name customer
,(SELECT SUM(p.sum) FROM payment p WHERE p.request_id = r.id)/100 as sum 
FROM request r 

JOIN equipment e ON e.id = r.equipment_id 
JOIN customer c ON c.id = e.customer_id 

WHERE (SELECT SUM(p.sum) FROM payment p WHERE p.request_id = r.id) < 0

GROUP BY customerId, requestId
ORDER BY sum, r.created DESC ";

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
