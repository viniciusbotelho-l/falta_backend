<?php

include("conexao.php");
include("valida.php");

$cpf = $_POST['cpf'];

$sql = "delete from usuarios where cpf = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $cpf);
    if($stmt->execute()){
        header("Location: cadastroUsuarios.php");
    }else{
        echo 'erro ao inserir usuario';
    }
}