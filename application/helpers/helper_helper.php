<?php
	defined('BASEPATH') OR exit('No direct script access allowed');


	function prettyDump($data = null, $die = false)
	{
        echo "<pre style='text-align: left; font-size: 14px'>";
        print_r($data);
        echo "</pre>";
        if ($die) die;
	}


