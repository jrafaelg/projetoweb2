<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=bdcontrolepatrimonio","root", "1");
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //echo "<p>Banco de dados conectado com sucesso!</p>";
} catch (PDOException $erro) {

    /**
     * final public Exception::getCode(): int
     * final public Exception::getFile(): string
     * final public Exception::getLine(): int
     * final public Exception::getTrace(): array
     * final public Exception::getTraceAsString(): string
     */

    $logFile = 'app.log'; // Adjust this path
    //America/Sao_Paulo
    date_default_timezone_set('America/Sao_Paulo');
    $timestamp = date('Y-m-d H:i:s');

    $logEntry = "[$timestamp] " . PHP_EOL;
    $logEntry .= $erro->getMessage() . PHP_EOL;
    $logEntry .= $erro->getCode() . PHP_EOL;
    $logEntry .= $erro->getTraceAsString() . PHP_EOL;
    $logEntry .= $erro->getFile() . PHP_EOL;
    $logEntry .= '---------------------------------------';
    $logEntry .= PHP_EOL;
    $logEntry .= '---------------------------------------';
    $logEntry .= PHP_EOL;
    
    if (file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX) === false) {
        // Handle error if logging fails (e.g., log to PHP's error_log)
        error_log("Failed to write to log file: $logFile");
    }

    echo "<h2 style='color:red;'>Erro: " . $erro->getMessage() . 
        "</h2>";

    exit(1);
}
