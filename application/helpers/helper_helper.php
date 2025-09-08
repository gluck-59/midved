<?php
	defined('BASEPATH') OR exit('No direct script access allowed');


function prettyDump($data = null, $die = false, $showStack = false) {
    if (in_array($_SERVER['SERVER_ADDR'], ['127.0.0.1', '::1', '0.0.0.0', 'localhost'])) {
        $stack = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        echo "<pre style='text-align: left;font-size: 14px;font-family: Courier, monospace; background-color: #f4f4f4; width: fit-content; opacity: .9; z-index: 999;position: relative;margin: 0 0 0 300px;'>";
        if ($showStack) print_r($stack);
        if ($stack[0]['function'] == 'prettyDump') {
            echo __FUNCTION__ . '() из ' . $stack[0]['file'] . ' line ' . $stack[0]['line'] . '<br>';
        } else {
//			print_r($stack);
            echo __FUNCTION__ . '() из ' . ($stack[1]['args'][0] ? $stack[1]['args'][0] : $stack[2]['file']) . ' строка ' . $stack[0]['line'] . ':<br>';
        }

        if (is_bool($data) || is_null($data) || empty($data)) var_dump($data);
        else print_r($data);

        echo "</pre><br>";
        if ($die) die;
    }
}


