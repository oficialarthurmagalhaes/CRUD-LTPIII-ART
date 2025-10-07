<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "crud_arthuris";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if(!$conexao){
    die("Erro de conexão com o banco de dados. Detalhes: " . mysqli_connect_error());
}
?>