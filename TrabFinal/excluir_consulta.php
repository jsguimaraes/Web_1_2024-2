<?php
session_start();
include 'conexao.php';

$id_usuario = $_SESSION['id_usuario'];
$id_consulta = $_GET['id'];

$sql = "DELETE FROM consultas WHERE id='$id_consulta' AND id_usuario='$id_usuario'";

if (mysqli_query($conn, $sql)) {
    echo "Consulta excluída com sucesso!";
} else {
    echo "Erro: " . mysqli_error($conn);
}

header("Location: painel.php");
mysqli_close($conn);
?>