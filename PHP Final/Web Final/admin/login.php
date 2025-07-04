<?php
// admin/login.php - Página de Login da Área Administrativa

// Inclui o arquivo de configuração (com a conexão ao banco de dados)
include('../includes/config.php');

// Inicia a sessão PHP (necessário para gerenciar o estado de login)
session_start();

// Redireciona se o usuário já estiver logado
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("location: dashboard.php"); // Redireciona para o dashboard se já logado
    exit;
}

$email = $senha = "";
$email_err = $senha_err = $login_err = "";

// Processa os dados do formulário quando ele é enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Validação básica de entrada
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor, insira o email.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["senha"]))) {
        $senha_err = "Por favor, insira sua senha.";
    } else {
        $senha = trim($_POST["senha"]);
    }

    // 2. Validação das credenciais no banco de dados
    if (empty($email_err) && empty($senha_err)) {
        $sql = "SELECT id, nome, email, senha FROM usuarios_admin WHERE email = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Vincula variáveis ao statement preparado como parâmetros
            $stmt->bind_param("s", $param_email);
            $param_email = $email;

            // Tenta executar o statement preparado
            if ($stmt->execute()) {
                // Armazena o resultado
                $stmt->store_result();

                // Verifica se o email existe, se sim, verifica a senha
                if ($stmt->num_rows == 1) {
                    // Vincula as variáveis do resultado
                    $stmt->bind_result($id, $nome, $email_db, $hashed_senha_db);

                    if ($stmt->fetch()) {
                        // ATENÇÃO: No Passo 3 anterior, inserimos a senha como texto puro '123456'.
                        // Para um sistema real, a senha DEVE SER HASHED.
                        // Por enquanto, vamos comparar a senha em texto puro para teste.
                        // MAIS TARDE, substituiremos isso por password_verify($senha, $hashed_senha_db)
                        if ($senha === $hashed_senha_db) { // Comparação temporária para '123456'
                        // if (password_verify($senha, $hashed_senha_db)) { // <-- Linha correta para senhas HASHEADAS

                            // Senha correta, inicia uma nova sessão
                            session_start();

                            // Armazena dados em variáveis de sessão
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["nome"] = $nome;
                            $_SESSION["email"] = $email_db;

                            // Redireciona o usuário para a página do dashboard
                            header("location: dashboard.php");
                            exit; // Garante que o script pare de executar após o redirecionamento
                        } else {
                            // Senha inválida
                            $login_err = "Email ou senha inválidos.";
                        }
                    }
                } else {
                    // Email não encontrado
                    $login_err = "Email ou senha inválidos.";
                }
            } else {
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fecha o statement
            $stmt->close();
        }
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>

<?php include('../includes/header.php'); // Note o '../' para voltar uma pasta ?>

<main class="login-container">
    <section class="login-box">
        <h2>Login Administrativo</h2>
        <p>Por favor, preencha suas credenciais para fazer login.</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control <?php echo (!empty($senha_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $senha_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Entrar">
            </div>
        </form>
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
        flex-direction: column; /* Para alinhar header, main e footer */
    }
    .login-container {
        flex-grow: 1; /* Permite que o main cresça e empurre o footer para baixo */
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }
    .login-box {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        text-align: center;
    }
    .login-box h2 {
        margin-bottom: 20px;
        color: #333;
    }
    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }
    .form-control {
        width: calc(100% - 20px); /* Ajuste para padding */
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875em;
        display: block;
        margin-top: 5px;
    }
    .btn {
        background-color: #ff7f00; /* Cor do seu logo */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
        width: 100%;
    }
    .btn:hover {
        background-color: #e67300;
    }
    .alert {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 4px;
        font-size: 14px;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    /* Ajustes para o header e footer */
    header {
        width: 100%;
        position: static; /* Não fixo para não cobrir o form */
        top: 0;
        left: 0;
        z-index: 1000;
    }
    footer {
        width: 100%;
        margin-top: auto; /* Empurra o footer para o final */
        padding: 20px 0;
        background-color: #333; /* Cor de fundo para o footer */
        color: #fff;
        text-align: center;
    }
</style>