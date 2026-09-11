<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
session_destroy();

// Impede que o navegador guarde a página logada no cache ao clicar na setinha de voltar
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");

header("Location: login.html");
exit;
?>