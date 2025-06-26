<?php
// Ficheiro 1: db_conexao.php
// ----------------------------
// Responsável por conectar à base de dados.

// Força a exibição de erros para diagnóstico
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configurações da Base de Dados
$servidor = "localhost";
$usuario_db = "root";
$senha_db = "";
$nome_banco = "meu_login_db"; // Garanta que este é o nome exato da sua base de dados

// Tenta a conexão
$conexao = new mysqli($servidor, $usuario_db, $senha_db, $nome_banco);

// Verifica se a conexão falhou
if ($conexao->connect_error) {
    // Para o script e envia uma resposta JSON de erro
    http_response_code(500);
    echo json_encode([
        'sucesso' => false,
        'mensagem' => "Erro fatal de conexão com a BD: " . $conexao->connect_error
    ]);
    exit();
}

$conexao->set_charset("utf8");

?>