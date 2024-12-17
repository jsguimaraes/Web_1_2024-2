<?php
session_start();
include 'conexao.php';

$email = $_POST['email'];
$senha = md5($_POST['senha']);

$sql = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $usuario = mysqli_fetch_assoc($result);
    $_SESSION['id_usuario'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    header("Location: painel.php");
} else {
    echo "Email ou senha incorretos!";
}

mysqli_close($conn);
?>