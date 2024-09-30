<?php
session_start(); // Inicie a sessão

// Verifique se a variável clinica_id está definida
if (!isset($_POST['clinica_id'])) {
    die("Nenhuma clínica encontrada com este ID.");
}

$clinica_id = $_POST['clinica_id'];
$data = $_POST['data'];
$horario = $_POST['horario'];
$disponibilidade = $_POST['disponibilidade'];

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

// Preparando a consulta
$sql = "INSERT INTO horarios (data, horario, disponibilidade, clinica_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $data, $horario, $disponibilidade, $clinica_id);

if ($stmt->execute()) {
    $_SESSION['message'] = "Horário adicionado com sucesso!";
} else {
    $_SESSION['message'] = "Erro ao adicionar horário: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirecionando para a página de adicionar horários
header("Location: adicionar_horarios.php");
exit();
?>
