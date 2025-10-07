<?php

include "conexao.php";

$nome_completo = $_POST["nome_completo"];
$nome_usuario = $_POST["nome_usuario"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$query = "INSERT INTO usuarios (nome_completo,nome_usuario, email, senha) VALUES ('$nome_completo','$nome_usuario', '$email','$senha')";

if(mysqli_query($conexao, $query)){
    header("Location: /oficinaHTMLCSS/index.php");
    exit;
}
else{
    echo "erro ao inserir!" . mysqli_error($conexao);
}

?>