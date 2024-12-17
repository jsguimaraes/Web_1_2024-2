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
    <title>Marcar Consulta - Agenda Veterinária</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="painel.php">Meu Novo Sistema</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="painel.php">Atendimentos Agendados</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    Olá, <?php echo $_SESSION['nome']; ?>, você está conectado ao Meu Novo Sistema!
                    <a href="index.php" class="btn btn-outline-light btn-sm ms-2">Sair</a>
                </span>
            </div>
        </div>
    </nav>

   <div class="container mt-4">
        <h2 class="mb-4">Marcar Nova Consulta</h2>

        <?php if (isset($_SESSION['erros'])): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($_SESSION['erros'] as $erro): ?>
                        <li><?php echo $erro; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php unset($_SESSION['erros']); // Limpa os erros após exibir ?>
        <?php endif; ?>

        <form action="processa_marcacao.php" method="post">
            <div class="mb-3">
                <label for="idade" class="form-label">Idade:</label>
                <input type="number" name="idade" id="idade" class="form-control" min="1" max="120" required>
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Data:</label>
                <input type="date" name="data" id="data" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora:</label>
                <input type="time" name="hora" id="hora" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo:</label>
                <textarea name="motivo" id="motivo" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Marcar Consulta</button>
        </form>
    </div>

</body>
</html>