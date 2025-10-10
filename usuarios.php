<?php
include "conexao.php";

// Consulta todos os usuários
$query = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexao, $query);

// Verifica se houve erro na consulta
if ($resultado === false) {
    die("Erro na consulta SQL: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Gerenciamento de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Gerenciamento de Usuários</h2>

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
                    <td class="text-center"><?= htmlspecialchars($usuario['id_usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['nome_completo']) ?></td>
                    <td><?= htmlspecialchars($usuario['matricula']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td class="text-center">
                        <!-- Botão Visualizar -->
                        <button class="btn btn-info btn-sm text-white" 
                            data-bs-toggle="modal" 
                            data-bs-target="#visualizarModal" 
                            data-id="<?= htmlspecialchars($usuario['id_usuario']) ?>"
                            data-nome="<?= htmlspecialchars($usuario['nome_completo']) ?>"
                            data-matricula="<?= htmlspecialchars($usuario['matricula']) ?>"
                            data-email="<?= htmlspecialchars($usuario['email']) ?>">
                            Visualizar
                        </button>

                        <!-- Botões apenas ilustrativos -->
                        <button class="btn btn-warning btn-sm" disabled>Editar</button>
                        <button class="btn btn-danger btn-sm" disabled>Excluir</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Nenhum usuário cadastrado.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal de Visualização -->
<div class="modal fade" id="visualizarModal" tabindex="-1" aria-labelledby="visualizarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="visualizarModalLabel">Detalhes do Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <p><strong>ID:</strong> <span id="view-id"></span></p>
        <p><strong>Nome Completo:</strong> <span id="view-nome"></span></p>
        <p><strong>Matrícula:</strong> <span id="view-matricula"></span></p>
        <p><strong>Email:</strong> <span id="view-email"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Preenche o modal com os dados do usuário
const visualizarModal = document.getElementById('visualizarModal');
visualizarModal.addEventListener('show.bs.modal', event => {
  const button = event.relatedTarget;
  document.getElementById('view-id').textContent = button.getAttribute('data-id');
  document.getElementById('view-nome').textContent = button.getAttribute('data-nome');
  document.getElementById('view-matricula').textContent = button.getAttribute('data-matricula');
  document.getElementById('view-email').textContent = button.getAttribute('data-email');
});
</script>

</body>
</html>
