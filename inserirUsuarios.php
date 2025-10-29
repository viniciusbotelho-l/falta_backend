<?php

include("conexao.php");
include("valida.php");

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$senha = $_POST['senha'];

$sql = "insert into usuarios (cpf,nome,senha) values(?,?,?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sss", $cpf, $nome, $senha);
    if($stmt->execute()){
        header("Location: cadastroUsuarios.php");
    }else{
        echo 'erro ao inserir usuario';
    }
}