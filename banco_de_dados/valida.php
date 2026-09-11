<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "orangedi_PI", "1234567890", "orangedi_PI");

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta no banco
$sql = "SELECT * FROM cadastro WHERE email = '$email' AND senha = '$senha'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
    $_SESSION['login'] = $usuario['email'];
    $_SESSION['nome']  = $usuario['nome']; 

    header("Location: ../index.php");
    exit();
} else {
    header("Location: ../login.html?erro=1");
    exit();
}

// Fecha conexão
$conn->close();
?>