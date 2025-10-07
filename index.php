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
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="box">
            <form>
                <h1>Login</h1>
                <input id="email" type="email" placeholder="Email" required>
                <input id="senha" type="password" placeholder="Senha" required>
                <input id="login" type="submit" value="Login">
                <a href="">Esqueceu a senha?</a>
                <a href="cadastro.php">Não tem Login? Cadastre-se</a>
            </form>
        </div>
    </div>
    <main>
        <!--
include "conexao.php";

$query = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexao, $query);

if(mysqli_num_rows($resultado) > 0){
    echo "<h1> Lista de Usuários </h1>";
    echo ("Número de Usuários: " . mysqli_num_rows($resultado) . "<br><br>");

    while($usuario = mysqli_fetch_array($resultado)){
        echo "Nome: " . $usuario["nome_completo"] . "<br>";
        echo "Nome: " . $usuario["nome_usuario"] . "<br>";
        echo "Email: " . $usuario["email"] . "<br>";
    };
}
else{
    echo "Nenhum dado encontrado!";
}
-->
    </main>
</body>
</html>


