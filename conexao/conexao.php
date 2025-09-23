<?php

// error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
// phpinfo();
// exit();



//require_once("helper/logger.php");
include $_SERVER['DOCUMENT_ROOT']."/projetoweb2/helper/logger.php";


try {
    $conn = new PDO("mysql:host=localhost;dbname=bdcontrolepatrimonio","root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "<p>Banco de dados conectado com sucesso!</p>";
} catch (Exception $erro) {

    $logEntry = $erro->getMessage() . PHP_EOL;
    $logEntry .= $erro->getCode() . PHP_EOL;
    $logEntry .= $erro->getTraceAsString() . PHP_EOL;
    $logEntry .= $erro->getFile();
    
    logger($logEntry);

    echo "<h2 style='color:red;'>Erro: " . $erro->getMessage() . "</h2>";

    exit(0);
}
