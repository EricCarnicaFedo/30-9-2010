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
    $nomeAnimal = $_POST['nomeAnimal'] ?? null;
    $especie = $_POST['especie'] ?? null;
    $raca = $_POST['raca'] ?? null;
    $idade = $_POST['idade'] ?? null;
    $sexo = $_POST['sexo'] ?? null;
    $dataNascimento = $_POST['dataNascimento'] ?? null;
    $tutorId = $_POST['tutor'] ?? null; // Este deve ser o ID do tutor selecionado
    $telefoneDono = $_POST['telefoneDono'] ?? null;
    $emailDono = $_POST['emailDono'] ?? null;
    $enderecoDono = $_POST['enderecoDono'] ?? null;

    // Inserindo dados na tabela pacientes
    $sql = "INSERT INTO pacientes (nome, especie, raca, idade, sexo, data_nascimento, tutor_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssi", $nomeAnimal, $especie, $raca, $idade, $sexo, $dataNascimento, $tutorId);

    if ($stmt->execute()) {
        // Busca o nome do dono usando o ID do tutor
        $sqlTutor = "SELECT nome FROM clientes WHERE idCliente = ?";
        $stmtTutor = $conn->prepare($sqlTutor);
        $stmtTutor->bind_param("i", $tutorId);
        $stmtTutor->execute();
        $stmtTutor->bind_result($nomeDono);
        $stmtTutor->fetch();
        $stmtTutor->close();

        // Se o dono já existe, informamos
        if ($nomeDono) {
            $_SESSION['message'] = "Paciente adicionado com sucesso! Dono: " . $nomeDono;
        } else {
            // Adicionando informações do dono na tabela clientes, caso o dono não exista
            $sqlCliente = "INSERT INTO clientes (nome, email, telefone, endereco) VALUES (?, ?, ?, ?)";
            $stmtCliente = $conn->prepare($sqlCliente);
            $stmtCliente->bind_param("ssss", $nomeDono, $emailDono, $telefoneDono, $enderecoDono);

            if ($stmtCliente->execute()) {
                $_SESSION['message'] = "Paciente adicionado com sucesso! Dono adicionado.";
            } else {
                $_SESSION['message'] = "Paciente adicionado, mas erro ao adicionar dono: " . $stmtCliente->error;
            }

            $stmtCliente->close();
        }
    } else {
        $_SESSION['message'] = "Erro ao adicionar paciente: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    exit();
}
?>
