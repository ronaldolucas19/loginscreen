<?php
// Ficheiro: api_login.php (Controller)
session_start();
header('Content-Type: application/json');

// Usamos require_once para garantir que cada ficheiro é incluído apenas uma vez.
require_once 'db_conexao.php';
require_once 'Logger.php';
require_once 'UsuarioDAO.php';
require_once 'UsuarioService.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Logger::warning("Recebida uma requisição com método inválido: " . $_SERVER['REQUEST_METHOD']);
    http_response_code(405);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Método não permitido.']);
    exit();
}

$dados = json_decode(file_get_contents('php://input'));
if (!$dados || !isset($dados->email) || !isset($dados->password)) {
    Logger::warning("Recebida uma requisição com estrutura de dados inválida.");
    http_response_code(400);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Estrutura de dados inválida.']);
    exit();
}

Logger::info("Recebida tentativa de login para o email: " . $dados->email);

try {
    $usuarioDAO = new UsuarioDAO($conexao);
    $usuarioService = new UsuarioService($usuarioDAO);
    $resultadoLogin = $usuarioService->tentarLogin($dados->email, $dados->password);

    if ($resultadoLogin['sucesso']) {
        $_SESSION['usuario_id'] = $resultadoLogin['dados_usuario']['id'];
        $_SESSION['usuario_email'] = $resultadoLogin['dados_usuario']['email'];
        http_response_code(200);
        echo json_encode(['sucesso' => true, 'mensagem' => $resultadoLogin['mensagem']]);
    } else {
        http_response_code(401);
        echo json_encode(['sucesso' => false, 'mensagem' => $resultadoLogin['mensagem']]);
    }
} catch (Exception $e) {
    Logger::error("Erro inesperado no Controller: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['sucesso' => false, 'mensagem' => 'Ocorreu um erro interno inesperado.']);
} finally {
    if (isset($conexao)) {
        $conexao->close();
    }
}
?>
