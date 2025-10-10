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
    <title>Painel ADM</title>
</head>
<body>
    <main>
    
    <?php
    include "conexao.php";
    //VERIFICAR AUTENTICAÇÃO DE USUÁRIO E SENHA
    // $email = $_POST["email"];
    // $email = $_POST["senha"];

    $query = "SELECT * FROM usuarios";
    $resultado = mysqli_query($conexao, $query);

    if(mysqli_num_rows($resultado) > 0){
        echo "<h1> Lista de Usuários </h1>";
        echo ("Número de Usuários: " . mysqli_num_rows($resultado) . "<br><br>");

        // while($usuario = mysqli_fetch_array($resultado)){
        //     echo "Nome Completo: " . $usuario["nome_completo"];
        //     echo "<br>";
        //     echo "Matrícula: " . $usuario["matricula"];
        //     echo "<br>";
        //     echo "Email: " . $usuario["email"];
        //     echo "<br>";
        //     echo "<br>";
        // };
    }
    else{
        echo "Nenhum dado encontrado!";
    }
    ?>
    </main>
</body>
</html>


