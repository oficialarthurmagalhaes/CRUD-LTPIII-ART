<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit;
}

include "conexao.php";

// Função de exclusão
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $query = "DELETE FROM usuarios WHERE id_usuario = $id";
    mysqli_query($conexao, $query);
    header("Location: usuarios.php");
    exit;
}

// Função de edição
if (isset($_POST['editar'])) {
    $id = intval($_POST['id_usuario']);
    $nome = mysqli_real_escape_string($conexao, $_POST['nome_completo']);
    $matricula = mysqli_real_escape_string($conexao, $_POST['matricula']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $query = "UPDATE usuarios 
              SET nome_completo='$nome', matricula='$matricula', email='$email', senha='$senha'
              WHERE id_usuario=$id";
    mysqli_query($conexao, $query);
    header("Location: usuarios.php");
    exit;
}

// Função de cadastro
if (isset($_POST['cadastrar'])) {
    $nome = mysqli_real_escape_string($conexao, $_POST['nome_completo']);
    $matricula = mysqli_real_escape_string($conexao, $_POST['matricula']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    $query = "INSERT INTO usuarios (nome_completo, matricula, email, senha)
              VALUES ('$nome', '$matricula', '$email', '$senha')";
    mysqli_query($conexao, $query);
    header("Location: usuarios.php");
    exit;
}

// Consulta todos os usuários
$resultado = mysqli_query($conexao, "SELECT * FROM usuarios ORDER BY id_usuario ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- ========== NAVBAR SUPERIOR ========== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold text-white" href="#">Painel Administrativo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'usuarios.php' ? 'active' : '' ?>" href="usuarios.php">Usuários</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>" href="dashboard.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-danger fw-bold" href="logout.php">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- ===================================== -->

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gerenciamento de Usuários</h2>
        <!-- Botão de cadastro -->
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cadastroModal">+ Cadastrar Usuário</button>
    </div>

    <table class="table table-striped table-bordered shadow-sm">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Nome Completo</th>
                <th>Matrícula</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($resultado) > 0): ?>
            <?php while ($usuario = mysqli_fetch_assoc($resultado)): ?>
                <tr>
                    <td class="text-center"><?= $usuario['id_usuario'] ?></td>
                    <td><?= htmlspecialchars($usuario['nome_completo']) ?></td>
                    <td><?= htmlspecialchars($usuario['matricula']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td class="text-center">
                        <button class="btn btn-info btn-sm text-white" 
                            data-bs-toggle="modal" 
                            data-bs-target="#visualizarModal" 
                            data-id="<?= $usuario['id_usuario'] ?>"
                            data-nome="<?= htmlspecialchars($usuario['nome_completo']) ?>"
                            data-matricula="<?= htmlspecialchars($usuario['matricula']) ?>"
                            data-email="<?= htmlspecialchars($usuario['email']) ?>"
                            data-senha="<?= htmlspecialchars($usuario['senha']) ?>">
                            Visualizar
                        </button>

                        <button class="btn btn-warning btn-sm text-white"
                            data-bs-toggle="modal"
                            data-bs-target="#editarModal"
                            data-id="<?= $usuario['id_usuario'] ?>"
                            data-nome="<?= htmlspecialchars($usuario['nome_completo']) ?>"
                            data-matricula="<?= htmlspecialchars($usuario['matricula']) ?>"
                            data-email="<?= htmlspecialchars($usuario['email']) ?>"
                            data-senha="<?= htmlspecialchars($usuario['senha']) ?>">
                            Editar
                        </button>

                        <a href="usuarios.php?excluir=<?= $usuario['id_usuario'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
                           Excluir
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="5" class="text-center">Nenhum usuário cadastrado.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Cadastrar -->
<div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Cadastrar Novo Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form method="POST" action="usuarios.php">
        <div class="modal-body">
          <div class="mb-3">
            <label for="cad-nome" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" name="nome_completo" id="cad-nome" required>
          </div>
          <div class="mb-3">
            <label for="cad-matricula" class="form-label">Matrícula</label>
            <input type="text" class="form-control" name="matricula" id="cad-matricula" required>
          </div>
          <div class="mb-3">
            <label for="cad-email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="cad-email" required>
          </div>
          <div class="mb-3">
            <label for="cad-senha" class="form-label">Senha</label>
            <input type="text" class="form-control" name="senha" id="cad-senha" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="cadastrar" class="btn btn-success">Cadastrar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Outros modais (Visualizar e Editar) -->
<!-- ... (mantém os seus modais existentes) ... -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Modal Visualizar
const visualizarModal = document.getElementById('visualizarModal');
visualizarModal.addEventListener('show.bs.modal', event => {
  const btn = event.relatedTarget;
  document.getElementById('view-id').textContent = btn.getAttribute('data-id');
  document.getElementById('view-nome').textContent = btn.getAttribute('data-nome');
  document.getElementById('view-matricula').textContent = btn.getAttribute('data-matricula');
  document.getElementById('view-email').textContent = btn.getAttribute('data-email');
  document.getElementById('view-senha').textContent = btn.getAttribute('data-senha');
});

// Modal Editar
const editarModal = document.getElementById('editarModal');
editarModal.addEventListener('show.bs.modal', event => {
  const btn = event.relatedTarget;
  document.getElementById('edit-id').value = btn.getAttribute('data-id');
  document.getElementById('edit-nome').value = btn.getAttribute('data-nome');
  document.getElementById('edit-matricula').value = btn.getAttribute('data-matricula');
  document.getElementById('edit-email').value = btn.getAttribute('data-email');
  document.getElementById('edit-senha').value = btn.getAttribute('data-senha');
});
</script>

</body>
</html>