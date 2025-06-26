<?php
// Ficheiro: painel.php
// --------------------
// Esta é a nossa página protegida.

// Inicia a sessão para poder aceder às variáveis de sessão
session_start();

// Verifica se o utilizador está autenticado.
// Se a variável 'usuario_id' não existir na sessão, significa que não fez login.
if (!isset($_SESSION['usuario_id'])) {
    // Redireciona o utilizador para a página de login
    header('Location: login.html');
    // Encerra a execução do script para garantir que nada mais é mostrado
    exit();
}

// Se o script chegou até aqui, o utilizador está autenticado.
// Podemos usar os dados guardados na sessão.
$email_do_utilizador = htmlspecialchars($_SESSION['usuario_email']);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controlo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Bem-vindo ao seu Painel!</h1>
        <p class="text-gray-600 mb-6">Você está logado como: <span class="font-semibold"><?php echo $email_do_utilizador; ?></span></p>
        <a href="api_logout.php" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
            Sair (Logout)
        </a>
    </div>
</body>
</html>
