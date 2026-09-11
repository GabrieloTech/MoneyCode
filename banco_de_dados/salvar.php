<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco
$conn = new mysqli("localhost", "orangedi_PI", "1234567890", "orangedi_PI");

// Pegando dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// 1. Verifica se o e-mail já está cadastrado
$check = $conn->query("SELECT * FROM cadastro WHERE email = '$email'");

if ($check->num_rows > 0) {
    // Se encontrou o e-mail, avisa na tela de cadastro
    header("Location: ../cadastro.html?status=erro_email");
    exit();
}

// 2. Se não existir, faz o cadastro
$sql = "INSERT INTO cadastro (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../login.html");
    exit();
} else {
    header("Location: ../cadastro.html?status=erro");
    exit();
}

// Fecha conexão
$conn->close();
?>