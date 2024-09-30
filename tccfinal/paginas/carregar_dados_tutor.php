<?php
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

// Recuperando os dados do tutor
if (isset($_GET['id'])) {
    $tutorId = intval($_GET['id']);
    $query = "SELECT telefone, email, endereco FROM tutores WHERE id = $tutorId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $tutorData = $result->fetch_assoc();
        echo json_encode($tutorData); // Retorna os dados em formato JSON
    } else {
        echo json_encode(['telefone' => '', 'email' => '', 'endereco' => '']);
    }
} else {
    echo json_encode(['telefone' => '', 'email' => '', 'endereco' => '']);
}

$conn->close();
?>
