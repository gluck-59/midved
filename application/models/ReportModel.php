<?php

    class ReportModel extends CI_Model
    {
		public function __construct()
		{

		}

		public function execRequest($sql) {
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
