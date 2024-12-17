<?php
$servername = "127.0.0.1";
$username = "root"; // ou o nome de usuário do banco de dados
$password = ""; // ou a senha do banco de dados
$dbname = "meu_novo_sistema";


// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>