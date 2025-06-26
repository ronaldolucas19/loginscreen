<?php
// Ficheiro: Logger.php
// --------------------
// Classe estática para gerir os logs da aplicação.

class Logger {

    // Define os níveis de log para clareza
    private const INFO = 'INFO';
    private const WARNING = 'WARNING';
    private const ERROR = 'ERROR';

    /**
     * Escreve uma mensagem de log do tipo INFO.
     * @param string $message A mensagem a ser logada.
     */
    public static function info($message) {
        self::writeLog(self::INFO, $message);
    }

    /**
     * Escreve uma mensagem de log do tipo WARNING.
     * @param string $message A mensagem a ser logada.
     */
    public static function warning($message) {
        self::writeLog(self::WARNING, $message);
    }

    /**
     * Escreve uma mensagem de log do tipo ERROR.
     * @param string $message A mensagem a ser logada.
     */
    public static function error($message) {
        self::writeLog(self::ERROR, $message);
    }

    /**
     * Método privado que formata e escreve a mensagem no ficheiro de log.
     * @param string $level O nível do log (INFO, WARNING, ERROR).
     * @param string $message A mensagem.
     */
    private static function writeLog($level, $message) {
        // Define o caminho para a pasta de logs. __DIR__ é a pasta atual.
        $logDirectory = __DIR__ . '/logs';
        
        // Verifica se a pasta de logs não existe e tenta criá-la
        if (!is_dir($logDirectory)) {
            // mkdir cria a pasta, o 'true' permite criar pastas aninhadas recursivamente
            mkdir($logDirectory, 0755, true); 
        }

        // Define o caminho completo para o ficheiro de log
        $logFile = $logDirectory . '/app.log';

        // Formata a mensagem de log com data, hora, nível e a mensagem
        // O formato 'Y-m-d H:i:s' resulta em algo como '2025-06-25 01:18:00'
        $formattedMessage = sprintf(
            "[%s] [%s]: %s%s",
            date('Y-m-d H:i:s'),
            $level,
            $message,
            PHP_EOL // Adiciona uma quebra de linha no final (funciona em todos os sistemas operativos)
        );

        // Escreve a mensagem formatada no final do ficheiro de log
        // FILE_APPEND garante que não apagamos o conteúdo anterior
        // LOCK_EX previne que duas requisições escrevam no ficheiro ao mesmo tempo
        file_put_contents($logFile, $formattedMessage, FILE_APPEND | LOCK_EX);
    }
}

?>
