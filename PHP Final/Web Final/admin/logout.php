<?php
// admin/logout.php - Desloga o usuário

session_start(); // Inicia a sessão

// Destroi todas as variáveis de sessão
$_SESSION = array();

// Se a sessão for usada com cookies, também destrói o cookie da sessão
// Nota: isso destruirá a sessão, e não apenas os dados da sessão!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destrói a sessão
session_destroy();

// Redireciona para a página de login
header("location: login.php");
exit;
?>