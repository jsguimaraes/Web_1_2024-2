<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit;
}
include 'conexao.php';

$id_usuario = $_SESSION['id_usuario'];
$idade = $_POST['idade'];
$data = $_POST['data'];
$hora = $_POST['hora'];
$motivo = $_POST['motivo'];

$erros = [];

// Validar idade
if (!filter_var($idade, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 120]])) {
    $erros[] = "Idade inválida.";
}

// Validar data
$dataAtual = new DateTime();
$dataInput = DateTime::createFromFormat('Y-m-d', $data);

if (!$dataInput || $dataInput < $dataAtual) {
    $erros[] = "A data deve ser maior ou igual à data de hoje.";
}

// Validar hora
$horaValida = preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $hora);

if (!$horaValida) {
    $erros[] = "Hora inválida.";
}

// Validar motivo
if (empty(trim($motivo))) {
    $erros[] = "O motivo não pode estar em branco.";
}

// Exibir erros
if (!empty($erros)) {
     $_SESSION['erros'] = $erros;
     header("Location: marcar_consulta.php");
     exit;
} else {
   $sql = "INSERT INTO consultas (id_usuario, idade, data, hora, motivo) VALUES ('$id_usuario', '$idade', '$data', '$hora', '$motivo')";

    if (mysqli_query($conn, $sql)) {
        echo "Consulta marcada com sucesso!";
        header("Location: painel.php");
    } else {
        echo "Erro: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>