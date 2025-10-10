<?php
include "conexao.php";

// Total de usuários
$totalUsuariosQuery = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM usuarios");
$totalUsuarios = mysqli_fetch_assoc($totalUsuariosQuery)['total'];

// Usuários por mês (gráfico)
$usuariosPorMesQuery = mysqli_query($conexao, "
    SELECT MONTHNAME(data_cadastro) AS mes, COUNT(*) AS quantidade 
    FROM usuarios 
    WHERE YEAR(data_cadastro) = YEAR(CURDATE()) 
    GROUP BY MONTH(data_cadastro)
    ORDER BY MONTH(data_cadastro)
");

// Se o seu banco ainda não tiver a coluna data_cadastro, adicione:
# ALTER TABLE usuarios ADD data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP;

$meses = [];
$quantidades = [];
while ($row = mysqli_fetch_assoc($usuariosPorMesQuery)) {
    $meses[] = $row['mes'];
    $quantidades[] = $row['quantidade'];
}

// Últimos usuários
$ultimosUsuariosQuery = mysqli_query($conexao, "SELECT * FROM usuarios ORDER BY id_usuario DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Estatísticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Painel de Estatísticas</h2>
    <div class="d-flex justify-content-end mb-4">
    <a href="usuarios.php" class="btn btn-dark shadow">
        ← Voltar para Gerenciamento de Usuários
    </a>
</div>

    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="card shadow-lg border-0 p-3 bg-success text-white">
                <h4>Total de Usuários</h4>
                <h2><?= $totalUsuarios ?></h2>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-lg border-0 p-3">
                <h5 class="text-center">Usuários Cadastrados por Mês</h5>
                <canvas id="graficoUsuarios"></canvas>
            </div>
        </div>
    </div>

    <div class="card shadow-lg border-0 p-3">
        <h5 class="text-center mb-3">Últimos Usuários Cadastrados</h5>
        <table class="table table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome Completo</th>
                    <th>Matrícula</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = mysqli_fetch_assoc($ultimosUsuariosQuery)): ?>
                    <tr>
                        <td><?= $usuario['id_usuario'] ?></td>
                        <td><?= htmlspecialchars($usuario['nome_completo']) ?></td>
                        <td><?= htmlspecialchars($usuario['matricula']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>

<script>
const ctx = document.getElementById('graficoUsuarios');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($meses) ?>,
        datasets: [{
            label: 'Usuários por Mês',
            data: <?= json_encode($quantidades) ?>,
            borderWidth: 1,
            backgroundColor: 'rgba(0, 123, 255, 0.6)',
            borderColor: 'rgba(0, 123, 255, 1)',
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

</body>
</html>
