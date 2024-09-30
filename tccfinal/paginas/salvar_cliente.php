<?php
session_start(); // Inicia a sessão

// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'tccdois');

// Verifica se a conexão falhou
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $idCliente = isset($_POST['id']) ? $_POST['id'] : null;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
    $endereco = isset($_POST['endereco']) ? $_POST['endereco'] : null;
    $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : null;
    $estado = isset($_POST['estado']) ? $_POST['estado'] : null;
    $cep = isset($_POST['cep']) ? $_POST['cep'] : null;

    // Obtém o clinica_id da sessão
    $clinica_id = $_SESSION['clinica_id'] ; // Usando null coalescing

    // Verifica se clinica_id está definido
    if (!$clinica_id) {
        $_SESSION['message'] = "Clinica ID não está definido.";
        header("Location: adicionarcliente.php");
        exit();
    }

    if ($idCliente) {
        // Atualiza o registro existente
        $sql = "UPDATE clientes SET nome='$nome', email='$email', telefone='$telefone', endereco='$endereco', cidade='$cidade', estado='$estado', cep='$cep' WHERE idCliente='$idCliente'";
    } else {
        // Insere um novo registro
        $sql = "INSERT INTO clientes (nome, email, telefone, endereco, cidade, estado, cep, clinica_id) VALUES ('$nome', '$email', '$telefone', '$endereco', '$cidade', '$estado', '$cep', '$clinica_id')";
    }

    // Executa a consulta e define a mensagem de sessão
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Registro salvo com sucesso!";
    } else {
        $_SESSION['message'] = "Erro: " . $conn->error;
    }

    // Fecha a conexão
    $conn->close();

    // Redireciona para a página de listagem ou outra página
    header("Location: agenda.php"); // Substitua por sua página de destino
    exit(); // Importante para evitar que o script continue
}
?>
