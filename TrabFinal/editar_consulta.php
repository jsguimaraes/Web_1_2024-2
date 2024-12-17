<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

include 'conexao.php';

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    $id_consulta = $_GET['id'];

    // Busca a consulta no banco de dados
    $sql = "SELECT * FROM consultas WHERE id = ? AND id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_consulta, $_SESSION['id_usuario']);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se a consulta existe
    if ($result->num_rows > 0) {
        $consulta = $result->fetch_assoc();
    } else {
        echo "Consulta não encontrada ou você não tem permissão para editá-la.";
        exit;
    }
} else {
    echo "ID da consulta não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Consulta - Agenda Veterinária</title>
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
    <div class="container mt-4">
        <h2 class="mb-4">Editar Consulta</h2>
        <form action="processa_edicao.php" method="post">
            <input type="hidden" name="id" value="<?php echo $consulta['id']; ?>">
            <div class="mb-3">
                <label for="idade" class="form-label">Idade:</label>
                <input type="number" name="idade" id="idade" class="form-control" min="1" max="120" value="<?php echo $consulta['idade']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Data:</label>
                <input type="date" name="data" id="data" class="form-control" value="<?php echo $consulta['data']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="hora" class="form-label">Hora:</label>
                <input type="time" name="hora" id="hora" class="form-control" value="<?php echo $consulta['hora']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo:</label>
                <textarea name="motivo" id="motivo" class="form-control" rows="4" required><?php echo $consulta['motivo']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Consulta</button>
        </form>
    </div>
</body>
</html>