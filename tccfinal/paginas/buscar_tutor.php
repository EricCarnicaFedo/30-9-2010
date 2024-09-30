<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tccdois";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $tutorQuery = "SELECT telefone, email, endereco FROM tutores WHERE id = ?";
    $stmt = $conn->prepare($tutorQuery);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $tutor = $result->fetch_assoc();
        echo json_encode($tutor);
    } else {
        echo json_encode([]);
    }
}

$conn->close();
?>
