<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['login']) && !isset($_SESSION['email']) && !isset($_SESSION['nome'])) {
    header("Location: login.html");
    exit();
}

// Conexão com o banco de dados (mesma do seu cadastro)
$conn = new mysqli("localhost", "orangedi_PI", "1234567890", "orangedi_PI");

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Identifica o e-mail atual do usuário logado na sessão
$emailAntigo = $_SESSION['email'] ?? $_SESSION['login'] ?? '';

// Pegando os dados enviados pelo formulário
$novoNome = $_POST['nome'];
$novoEmail = $_POST['email'];
$novaSenha = $_POST['nova_senha'] ?? '';

// 1. Se o usuário alterou o e-mail, verifica se ele já pertence a outro cadastro no banco
if ($novoEmail !== $emailAntigo) {
    $check = $conn->query("SELECT * FROM cadastro WHERE email = '$novoEmail'");
    if ($check->num_rows > 0) {
        $conn->close();
        header("Location: perfil.php?status=erro_email_existente");
        exit();
    }
}

// 2. Monta a query dependendo se ele preencheu uma nova senha ou não
if (!empty($novaSenha)) {
    // Atualiza nome, email e senha
    $sql = "UPDATE cadastro SET nome = '$novoNome', email = '$novoEmail', senha = '$novaSenha' WHERE email = '$emailAntigo'";
} else {
    // Atualiza apenas nome e email, mantendo a senha antiga
    $sql = "UPDATE cadastro SET nome = '$novoNome', email = '$novoEmail' WHERE email = '$emailAntigo'";
}

// Executa a atualização
if ($conn->query($sql) === TRUE) {
    // Atualiza os dados na sessão para refletir instantaneamente no site
    $_SESSION['nome'] = $novoNome;
    $_SESSION['usuario_nome'] = $novoNome;
    $_SESSION['email'] = $novoEmail;
    $_SESSION['login'] = $novoEmail;

    $conn->close();
    header("Location: perfil.php?status=sucesso");
    exit();
} else {
    $conn->close();
    header("Location: perfil.php?status=erro");
    exit();
}
?>