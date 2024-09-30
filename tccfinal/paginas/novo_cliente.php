<?php
$conn = new mysqli('localhost', 'root', '', 'tccdois');

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    // Insere um novo registro
    $sql = "INSERT INTO clientes (nome, email, telefone, endereco, cidade, estado, cep) VALUES ('$nome', '$email', '$telefone', '$endereco', '$cidade', '$estado', '$cep')";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente adicionado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}

$conn->close();
?>
