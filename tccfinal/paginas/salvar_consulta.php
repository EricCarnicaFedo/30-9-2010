<?php
session_start(); // Inicie a sessão

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

// Capturando os dados do formulário
$nome_animal = $_POST['nome_animal'];
$raca = $_POST['raca'];
$proprietario = $_POST['proprietario'];
$data_hora_consulta = $_POST['data_hora_consulta']; // Aqui é a entrada única

// Separando a data e a hora
list($data_consulta, $hora_consulta) = explode(' ', $data_hora_consulta);

// Verificando a disponibilidade do horário
$sql_disponibilidade = "SELECT disponibilidade FROM horarios WHERE data = ? AND horario = ?";
$stmt_disponibilidade = $conn->prepare($sql_disponibilidade);
$stmt_disponibilidade->bind_param("ss", $data_consulta, $hora_consulta);
$stmt_disponibilidade->execute();
$result = $stmt_disponibilidade->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Se o horário estiver disponível, muda para reservado
    if ($row['disponibilidade'] === 'Disponível') {
        // Atualiza a disponibilidade para 'Reservado'
        $sql_update = "UPDATE horarios SET disponibilidade = 'Reservado' WHERE data = ? AND horario = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ss", $data_consulta, $hora_consulta);
        $stmt_update->execute();
        $stmt_update->close();
        
        // Definindo o status da consulta como 'Reservado'
        $status = 'Reservado';
    } else {
        $_SESSION['message'] = "Horário já reservado!";
        header("Location: adicionarconsulta.php");
        exit();
    }
} else {
    $_SESSION['message'] = "Horário não encontrado!";
    header("Location: adicionarconsulta.php");
    exit();
}

$descricao = $_POST['descricao'];

// Inserindo no banco de dados
$sql = "INSERT INTO consultas_marcadas (nome_animal, raca, proprietario, data_consulta, hora_consulta, descricao, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $nome_animal, $raca, $proprietario, $data_consulta, $hora_consulta, $descricao, $status);

if ($stmt->execute()) {
    $_SESSION['message'] = "Consulta adicionada com sucesso!";
} else {
    $_SESSION['message'] = "Erro ao adicionar consulta: " . $conn->error;
}

$stmt->close();
$conn->close();

// Atraso de 4 segundos
sleep(4);

// Redirecionando para a página de adicionar consulta
header("Location: adicionarconsulta.php");
exit();
