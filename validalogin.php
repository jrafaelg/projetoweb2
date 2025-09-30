<?php

include $_SERVER['DOCUMENT_ROOT']."/projetoweb2/conexao/conexao.php";

try {

    if (!empty($_POST['usuario'])){
        //echo 'deu certo: ' . $_POST['usuario'] . '<br>';
    }

    // $usuarios = $conn->exec($sql);

    // echo '<pre>';
    // echo '<br>';
    // var_dump($usuarios);

    // echo $sql;
    // exit;

    $usuario = !empty($_POST['usuario']) ? $_POST['usuario'] : '';
    $senha = !empty($_POST['senha']) ? $_POST['senha'] : '';

    echo '<pre>';
    echo "usuário digitado: $usuario";
    echo '<br>';
    echo "senha digitada: $senha";
    echo '<br>';

    // usuario: a' or  1=1  -- 


    $sql = "select * from tbusuarios t 
    where t.nome=:username and t.senha=:userpass and t.status = 'ativo'";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':username', $usuario, PDO::PARAM_STR);
    $stmt->bindValue(':userpass', $senha, PDO::PARAM_STR);


    $stmt->execute();

    $usuarios = $stmt->fetchAll();

    // LISTANDO OS USUARIOS RETORNADOS
    foreach ($usuarios as $usuario) {
        echo "ID: " . $usuario['id'] . " - Nome: " . $usuario['nome'] . "<br>";
    }

    // DUMP NA VARIÁVEL USUARIOS MOSTRANDO O RETORNO DO BANCO
    echo '<pre>';
    echo '<br>';
    var_dump($usuarios);
    exit();


    // sem proteção
    $sql = "select * from tbusuarios t 
    where t.nome = '" . $usuario . "' and t.senha='" . $senha . "' and t.status = 'ativo'";



    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $usuarios = $stmt->fetchAll();

    // LISTANDO OS USUARIOS RETORNADOS
    foreach ($usuarios as $usuario) {
        echo "ID: " . $usuario['id'] . " - Nome: " . $usuario['nome'] . "<br>";
    }

    // DUMP NA VARIÁVEL USUARIOS MOSTRANDO O RETORNO DO BANCO
    echo '<pre>';
    echo '<br>';
    var_dump($usuarios);






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