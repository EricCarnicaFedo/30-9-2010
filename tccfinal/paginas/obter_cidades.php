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

$estado_id = $_GET['estado_id'];

// SQL para obter cidades relacionadas ao estado
$sql = "SELECT id, nome FROM cidades WHERE estado_id = $estado_id"; // Ajuste conforme sua estrutura
$result = $conn->query($sql);

$cidades = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $cidades[] = $row;
    }
}

echo json_encode($cidades);
$conn->close();
?>