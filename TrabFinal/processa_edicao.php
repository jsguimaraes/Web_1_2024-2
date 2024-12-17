<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}

include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_consulta = $_POST['id'];
    $idade = $_POST['idade'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];

    // Atualiza a consulta no banco de dados
    $sql = "UPDATE consultas SET idade = ?, data = ?, hora = ?, motivo = ? WHERE id = ? AND id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssii", $idade, $data, $hora, $motivo, $id_consulta, $_SESSION['id_usuario']);

    if ($stmt->execute()) {
        header("Location: painel.php");
        exit;
    } else {
        echo "Erro ao atualizar a consulta: " . $stmt->error;
    }
} else {
    echo "Método de requisição inválido.";
}
?>