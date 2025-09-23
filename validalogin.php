<?php

include $_SERVER['DOCUMENT_ROOT']."/projetoweb2/conexao/conexao.php";

try {

    if (!empty($_POST['usuario'])){
        echo 'deu certo ' . $_POST['usuario'];
    }

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // usuario: a' or  1=1  -- 

    $sql = "select * from tbusuarios t 
    where t.nome = '" . $usuario . "' 
    and t.senha='" . $senha . "'
    and t.status = 'ativo'
    ";

    echo $sql;
    exit;

    $dados->$conn->execute($sql);


    //code...
} catch (Exception $e) {

    $logEntry = $e->getMessage() . PHP_EOL;
    $logEntry .= $e->getCode() . PHP_EOL;
    $logEntry .= $e->getTraceAsString() . PHP_EOL;
    $logEntry .= $e->getFile();
    
    logger($logEntry);

    echo "<h2 style='color:red;'>Erro: " . $e->getMessage() . "</h2>";

    exit(0);
}