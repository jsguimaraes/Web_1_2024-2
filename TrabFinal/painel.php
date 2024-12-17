<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Agenda Veterinária</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Agenda Veterinária</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="marcar_consulta.php">Agendar Atendimento</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    Bem-vindo, <?php echo $_SESSION['nome']; ?>!
                    <a href="index.php" class="btn btn-outline-light btn-sm ms-2">Sair</a>
                </span>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">Consultas Marcadas</h2>
        <!-- Aqui você exibirá as consultas marcadas usando PHP para preencher os dados da tabela -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Motivo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexao.php';
                $id_usuario = $_SESSION['id_usuario'];
                $sql = "SELECT * FROM consultas";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . date("d/m/Y", strtotime($row['data'])) . "</td>";
                        echo "<td>" . date("H:i", strtotime($row['hora'])) . "</td>";
                        echo "<td>" . $row['motivo'] . "</td>";
                        if ($row['id_usuario'] == $id_usuario) {
                            echo "<td><a href='editar_consulta.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Editar</a> ";
                            echo "<a href='excluir_consulta.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Excluir</a></td>";
                        } else {
                            echo "<td><span class='text-muted'>Não permitido</span></td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Nenhuma consulta marcada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>