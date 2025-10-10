<?php
session_start();

// Verifica se o formulário foi enviado
if (isset($_POST['entrar'])) {
    $senha = $_POST['senha'];

    // Senha do administrador
    if ($senha === "adm") {
        $_SESSION['logado'] = true;
        header("Location: usuarios.php");
        exit;
    } else {
        $erro = "Senha incorreta! Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="box">
        <form method="POST" class="shadow-lg p-4 rounded bg-white">
            <h1 class="mb-3 text-center text-primary">Acesso do Administrador</h1>

            <?php if (isset($erro)): ?>
                <div class="alert alert-danger text-center"><?= $erro ?></div>
            <?php endif; ?>

            <div class="mb-3 w-100">
                <label class="form-label">Senha:</label>
                <input type="password" name="senha" class="form-control" placeholder="Digite a senha de administrador" required>
            </div>

            <input type="submit" name="entrar" value="Entrar" class="btn btn-primary w-100">
            <a href="login.php" class="mt-3 d-block text-center">Voltar</a>
        </form>
    </div>
</div>

</body>
</html>
