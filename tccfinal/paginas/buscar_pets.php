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

// Verificando se o tutor_id foi passado
if (isset($_GET['tutor_id'])) {
    $tutor_id = intval($_GET['tutor_id']);
    
    // Recuperando pets do tutor selecionado
    $petsQuery = "SELECT id, nome FROM pets WHERE tutor_id = ?";
    $stmt = $conn->prepare($petsQuery);
    $stmt->bind_param("i", $tutor_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $pets = [];
    while ($pet = $result->fetch_assoc()) {
        $pets[] = $pet;
    }

    // Retornando os pets como JSON
    echo json_encode($pets);
}

$conn->close();
?>
