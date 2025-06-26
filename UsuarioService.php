<?php
// Ficheiro: UsuarioService.php (Service)
// Contém as regras de negócio e validações.

class UsuarioService {
    private $usuarioDAO;

    public function __construct(UsuarioDAO $usuarioDAO) {
        $this->usuarioDAO = $usuarioDAO;
    }

    public function tentarLogin($email, $password) {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['sucesso' => false, 'mensagem' => 'O formato do email é inválido.'];
        }
        if (empty($password)) {
            return ['sucesso' => false, 'mensagem' => 'O campo Palavra-passe é obrigatório.'];
        }

        $usuario = $this->usuarioDAO->buscarPorEmail($email);

        if ($usuario && $password == $usuario['senha']) {
            Logger::info("Login bem-sucedido para o email: " . $email);
            return [
                'sucesso' => true, 
                'mensagem' => 'Login bem-sucedido!',
                'dados_usuario' => [
                    'id' => $usuario['id'],
                    'email' => $usuario['email']
                ]
            ];
        }

        Logger::warning("Tentativa de login falhada para o email: " . $email);
        return ['sucesso' => false, 'mensagem' => 'Credenciais inválidas.'];
    }
}
?>
