
<?php
include('conexaobd.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta ao banco de dados para verificar o email
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    // Verifica se o usuário existe e se a senha está correta
    if ($usuario && md5($senha) == $usuario['senha']) {
        // A senha está correta

        // Armazena as informações do usuário na sessão
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['tipo'] = $usuario['tipo'];
        $_SESSION['nome_usuario'] = $usuario['nome'];

        // Armazena o clinica_id na sessão se o usuário for veterinário
        if ($usuario['tipo'] == 'veterinario') {
            $_SESSION['clinica_id'] = $usuario['clinica_id'];
        }

        // Redireciona o usuário com base no tipo de conta
        if ($usuario['tipo'] == 'tutor') {
            header("Location: tutor.php");
        } elseif ($usuario['tipo'] == 'veterinario') {
            header("Location: veterinario.php");
        }
        exit();
    } else {
        // Mensagem de erro para login inválido
        echo "Email ou senha incorretos!";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h1 class="titulo-login">Bem-vindo ao VetEtec!</h1>
    <div class="form-container login-form">
        <form method="POST" action="login.php">
            <img src="https://i.postimg.cc/v8pTmm2n/imageleft.png" class="image-do-formulario">
            <h1>Login</h1>
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit">Entrar</button>
            <p class="redirect-info">Não tem uma conta? <a href="cadastro.php" class="redirect-link">Cadastrar-se aqui</a></p>
        </form>
    </div>
</body>
</html>
