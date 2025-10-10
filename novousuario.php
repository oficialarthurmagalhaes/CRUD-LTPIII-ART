<?php

include "conexao.php";

$nome_completo = $_POST["nome_completo"];
$matricula = $_POST["matricula"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$query = "INSERT INTO usuarios (nome_completo, matricula, email, senha) VALUES ('$nome_completo','$matricula', '$email','$senha')";

if(mysqli_query($conexao, $query)){
    header("Location: index.php");
    exit;
}
else{
    echo "erro ao inserir!" . mysqli_error($conexao);
}

?>