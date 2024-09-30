<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "tcctres";

$conn = new mysqli($host, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Obtém o ID do pet
$pet_id = $_GET['id'];

// Exames Realizados
$exames_query = "SELECT * FROM exames_realizados WHERE idPet = $pet_id";
$exames_result = $conn->query($exames_query);
$exames = [];
while ($row = $exames_result->fetch_assoc()) {
    $exames[] = $row;
}

// Medicamentos Prescritos
$medicamentos_query = "SELECT * FROM medicamentos_prescritos WHERE nomeAnimal = (SELECT nome FROM pets WHERE id = $pet_id)";
$medicamentos_result = $conn->query($medicamentos_query);
$medicamentos = [];
while ($row = $medicamentos_result->fetch_assoc()) {
    $medicamentos[] = $row;
}

// Vacinas
$vacinas_query = "SELECT * FROM historico_vacinas WHERE idPet = $pet_id";
$vacinas_result = $conn->query($vacinas_query);
$vacinas = [];
while ($row = $vacinas_result->fetch_assoc()) {
    $vacinas[] = $row;
}

// Tratamentos
$tratamentos_query = "SELECT * FROM tratamentos WHERE pet_id = $pet_id";
$tratamentos_result = $conn->query($tratamentos_query);
$tratamentos = [];
while ($row = $tratamentos_result->fetch_assoc()) {
    $tratamentos[] = $row;
}

// Retorna como JSON
echo json_encode([
    'exames' => $exames,
    'medicamentos' => $medicamentos,
    'vacinas' => $vacinas,
    'tratamentos' => $tratamentos
]);

$conn->close();
?>
