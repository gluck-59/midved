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


		/*
имена стоблцов получать так
SELECT `TABLE_NAME`, `COLUMN_NAME`
FROM `INFORMATION_SCHEMA`.`COLUMNS`
WHERE `TABLE_SCHEMA`='medved'
AND `TABLE_NAME`in ('payment', 'request')
*/

    } // /class
