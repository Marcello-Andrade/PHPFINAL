<?php
// admin/dashboard.php - Página do Dashboard da Área Administrativa

// Inclui o arquivo de configuração (com a conexão ao banco de dados)
include('../includes/config.php');

// Inicia a sessão PHP
session_start();

// Verifica se o usuário NÃO está logado. Se não estiver, redireciona para a página de login.
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Variáveis de sessão para exibir informações do usuário
$user_id = $_SESSION['id'];
$user_nome = $_SESSION['nome'];
$user_email = $_SESSION['email'];
?>

<?php include('../includes/header.php'); // Note o '../' para voltar uma pasta ?>

<main class="dashboard-container">
    <section class="dashboard-content">
        <h2>Bem-vindo, <?php echo htmlspecialchars($user_nome); ?>!</h2>
        <p>Este é o painel de controle da área administrativa.</p>
        <p>Seu ID de usuário: <?php echo htmlspecialchars($user_id); ?></p>
        <p>Seu email: <?php echo htmlspecialchars($user_email); ?></p>

        <p>Aqui você poderá gerenciar usuários, conteúdos do site e mensagens de contato.</p>

        <p><a href="logout.php" class="btn btn-logout">Sair</a></p>
    </section>
</main>

<?php include('../includes/footer.php'); ?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        flex-direction: column;
    }
    .dashboard-container {
        flex-grow: 1;
        display: flex;
        justify-content: center;
        align-items: flex-start; /* Alinha o conteúdo ao topo */
        width: 100%;
        padding: 20px;
        box-sizing: border-box;
    }
    .dashboard-content {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 800px;
        text-align: center;
    }
    .dashboard-content h2 {
        margin-bottom: 20px;
        color: #333;
    }
    .dashboard-content p {
        margin-bottom: 10px;
        color: #555;
    }
    .btn-logout {
        background-color: #dc3545; /* Vermelho para logout */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
        text-decoration: none; /* Remover sublinhado do link */
        display: inline-block; /* Para o padding funcionar */
        margin-top: 20px;
    }
    .btn-logout:hover {
        background-color: #c82333;
    }
    /* Ajustes para header e footer, similar ao login.php */
    header {
        width: 100%;
        position: static;
        top: 0;
        left: 0;
        z-index: 1000;
    }
    footer {
        width: 100%;
        margin-top: auto;
        padding: 20px 0;
        background-color: #333;
        color: #fff;
        text-align: center;
    }
</style>