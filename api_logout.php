<?php
// Ficheiro: api_logout.php
// ------------------------
// Este script destrói a sessão e faz o logout do utilizador.

// Inicia a sessão para poder manipulá-la
session_start();

// 1. Limpa todas as variáveis de sessão
$_SESSION = array();

// 2. Destrói a sessão
session_destroy();

// 3. Redireciona o utilizador para a página de login
header("Location: login.html");
exit();

?>