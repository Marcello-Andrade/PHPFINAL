<?php
// includes/config.php - Configurações e Conexão com o Banco de Dados

// Definições para a conexão com o banco de dados
define('DB_SERVER', 'localhost'); // Geralmente 'localhost'
define('DB_USERNAME', 'root');   // Nome de usuário do seu MySQL (padrão XAMPP/WAMP é 'root')
define('DB_PASSWORD', '');       // Senha do seu MySQL (padrão XAMPP/WAMP é vazia, ou a que você configurou)
define('DB_NAME', 'burger_aatech'); // O nome do banco de dados que você criou

// Tentativa de conexão com o banco de dados
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conn->connect_error);
}

// Define o charset para evitar problemas com caracteres especiais
$conn->set_charset("utf8mb4");
?>