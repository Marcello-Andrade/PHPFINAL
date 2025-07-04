<?php
include('includes/config.php'); // Inclui o arquivo de conexão

if ($conn) {
    echo "Conexão com o banco de dados estabelecida com sucesso!";
    // Você pode tentar uma consulta simples para testar ainda mais
    $result = $conn->query("SELECT COUNT(*) FROM usuarios_admin");
    if ($result) {
        $row = $result->fetch_row();
        echo "<br>Número de usuários na tabela: " . $row[0];
    } else {
        echo "<br>Erro ao executar consulta de teste: " . $conn->error;
    }
} else {
    echo "Falha na conexão com o banco de dados.";
}

$conn->close(); // Fecha a conexão
?>