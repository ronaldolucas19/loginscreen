<?php
// Ficheiro: teste_final_conexao.php
// Um script de diagnóstico para encontrar o erro exato na conexão com a base de dados online.

// Ativar a exibição de todos os erros para diagnóstico
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Diagnóstico de Conexão com a Base de Dados</h1>";

// --- PREENCHA COM OS SEUS DADOS EXATOS DO INFINITYFREE ---
$servidor   = "sql309.infinityfree.com";
$usuario_db = "if0_39324460";
$senha_db   = "SUA_SENHA_AQUI"; // <-- IMPORTANTE: COLOQUE A SUA SENHA REAL AQUI
$nome_banco = "if0_39324460_loginscreen";
// --------------------------------------------------------

echo "<p><b>A tentar conectar com os seguintes dados:</b></p>";
echo "<ul>";
echo "<li>Servidor (Host): " . htmlspecialchars($servidor) . "</li>";
echo "<li>Utilizador: " . htmlspecialchars($usuario_db) . "</li>";
echo "<li>Base de Dados: " . htmlspecialchars($nome_banco) . "</li>";
echo "</ul>";

// Tenta criar a conexão
$conexao = new mysqli($servidor, $usuario_db, $senha_db, $nome_banco);

// Verifica o resultado
if ($conexao->connect_error) {
    echo "<h2 style='color: red;'>FALHA NA CONEXÃO</h2>";
    echo "<p><strong>A mensagem de erro exata é:</strong><br><pre style='background-color: #ffebeb; border: 1px solid red; padding: 10px;'>" . htmlspecialchars($conexao->connect_error) . "</pre></p>";
    echo "<hr>";
    echo "<p><strong>O que fazer:</strong><br>1. Compare CADA um dos dados acima com os que aparecem no seu painel do InfinityFree.<br>2. O erro mais comum é na <b>palavra-passe</b>. Garanta que copiou a palavra-passe correta da sua conta de alojamento.<br>3. Verifique se não há espaços em branco antes ou depois de cada dado.</p>";
} else {
    echo "<h2 style='color: green;'>SUCESSO!</h2>";
    echo "<p>A conexão com a base de dados foi estabelecida com sucesso!</p>";
    echo "<hr>";
    echo "<p>Isto prova que os seus dados estão corretos. Agora, copie e cole estes mesmos dados (servidor, utilizador, palavra-passe, nome da base de dados) para dentro do seu ficheiro <b>db_conexao.php</b>.</p>";
    $conexao->close();
}

?>
