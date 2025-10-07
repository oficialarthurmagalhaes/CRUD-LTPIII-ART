<?php
include "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <title>Cadastro</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <form action="./novousuario.php" method="post">
                <h1>Cadastro</h1>
                <input id="nome_completo" name="nome_completo" type="text" placeholder="Nome completo" required>
                <input id="nome_usuario" name="nome_usuario" type="text" placeholder="Nome do usuario" required>
                <input id="email" name="email" type="email" placeholder="Email" required>
                <input id="senha" name="senha" type="password" placeholder="Senha" required>
                <!--<input id="confirmarsenha" name="confirmarsenha" type="password" placeholder="Confirmar Senha" required>-->
                <input id="cadastrese" type="submit" value="Cadastre-se">
            </form>
        </div>
    </div>
</body>
</html>

