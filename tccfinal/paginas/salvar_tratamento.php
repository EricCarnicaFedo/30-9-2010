<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tccdois";

// Criando conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificando se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tutorId = $_POST['tutor'];
    $petId = $_POST['pet'];
    $descricao = $_POST['descricao'];
    $dataInicio = $_POST['dataInicio'];
    $dataFim = $_POST['dataFim'];
    $status = $_POST['status'];

    // Inserindo dados na tabela tratamentos
    $sql = "INSERT INTO tratamentos (tutor_id, pet_id, descricao, data_inicio, data_fim, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissss", $tutorId, $petId, $descricao, $dataInicio, $dataFim, $status);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Tratamento adicionado com sucesso!";
    } else {
        $_SESSION['message'] = "Erro ao adicionar tratamento: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    
    header("Location: adicionartratamento.php");
    exit();
}
?>
