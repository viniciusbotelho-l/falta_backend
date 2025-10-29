<?php

include("conexao.php");
include("valida.php");

$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];
$cpfAnterior = $_POST['cpfAnterior'];

$sql = "update usuarios set cpf = ?,
                            senha = ?,
                            nome =?
                    where cpf = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssss", $cpf,$senha,$nome,$cpfAnterior);
    if($stmt->execute()){
        header("Location: cadastroUsuarios.php");
    }else{
        echo 'erro ao inserir usuario';
    }
}