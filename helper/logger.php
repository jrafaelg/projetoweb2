<?php

function logger ($msg = ''){

    $logFile = 'app.log'; // Adjust this path
    //America/Sao_Paulo
    date_default_timezone_set('America/Sao_Paulo');
    $timestamp = date('Y-m-d H:i:s');

    $logEntry = "[$timestamp] " . PHP_EOL;
    $logEntry .= $_SERVER['REMOTE_ADDR'] . PHP_EOL;
    $logEntry .= $_SERVER['HTTP_USER_AGENT'] . PHP_EOL;
    $logEntry .= $msg . PHP_EOL;
    $logEntry .= '---------------------------------------';
    $logEntry .= PHP_EOL;
    $logEntry .= '---------------------------------------';
    $logEntry .= PHP_EOL;
    
    if (file_put_contents($logFile, $logEntry, FILE_APPEND) === false) {
        // Handle error if logging fails (e.g., log to PHP's error_log)
        error_log("Failed to write to log file: $logFile", 3, 'error.log');
    }

}