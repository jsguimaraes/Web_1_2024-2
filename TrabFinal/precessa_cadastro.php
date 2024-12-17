<?php
include 'conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);

$sql = "INSERT INTO usuario (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

if (mysqli_query($conn, $sql)) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro: " . mysqli_error($conn);
}

mysqli_close($conn);
?>