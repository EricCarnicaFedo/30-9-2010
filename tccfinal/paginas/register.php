<?php
// Conectar ao banco de dados
include('db_connect.php');

// Receber dados do formulário
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$userType = $_POST['userType'];
$clinic_id = $_POST['clinic_id'];
$clinicName = $_POST['clinic_name'];
$clinicAddress = $_POST['clinic_address'];
$clinicCity = $_POST['clinic_city'];
$clinicState = $_POST['clinic_state'];
$clinicZip = $_POST['clinic_zip'];

if ($userType === 'tutor') {
    // Inserir na tabela usuarios
    $sql = "INSERT INTO usuarios (nome, email, senha, tipo, clinica_id) VALUES (?, ?, ?, 'tutor', ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $password, $clinic_id);

    if ($stmt->execute()) {
        // Inserir na tabela clientes
        $sql = "INSERT INTO clientes (nome, email, clinica_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $name, $email, $clinic_id);
        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar cliente: " . $stmt->error;
        }
    } else {
        echo "Erro ao cadastrar tutor: " . $stmt->error;
    }
} else if ($userType === 'veterinario') {
    // Inserir na tabela clinicas
    $sql = "INSERT INTO clinicas (nome, endereco, cidade, estado, cep) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $clinicName, $clinicAddress, $clinicCity, $clinicState, $clinicZip);

    if ($stmt->execute()) {
        // Obter o ID da clínica recém-inserida
        $clinic_id = $stmt->insert_id;

        // Inserir na tabela usuarios
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo, clinica_id) VALUES (?, ?, ?, 'veterinario', ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $email, $password, $clinic_id);

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
        } else {
            echo "Erro ao cadastrar veterinário: " . $stmt->error;
        }
    } else {
        echo "Erro ao cadastrar clínica: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>
