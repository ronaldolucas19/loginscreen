<?php
// Ficheiro: UsuarioDAO.php (DAO)
// Responsável por comunicar com a tabela 'usuarios'.

class UsuarioDAO {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    public function buscarPorEmail($email) {
        $stmt = $this->conexao->prepare("SELECT id, email, senha FROM usuarios WHERE email = ?");
        
        if ($stmt === false) {
            Logger::error("Falha ao preparar a query de busca por email: " . $this->conexao->error);
            return null;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();
        $stmt->close();

        return $usuario;
    }
}
?>
