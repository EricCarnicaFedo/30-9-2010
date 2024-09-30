<?php
// Conexão com o banco de dados
$conn = new mysqli("localhost", "root", "", "tccdois");

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtém a clínica ID (você pode modificar isso conforme sua lógica de autenticação)
$clinica_id = $_SESSION['clinica_id'];

// Prepara a consulta para listar os horários da clínica
$sql = "SELECT id, data, horario, disponibilidade FROM horarios WHERE clinica_id = ? ORDER BY data, horario";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $clinica_id);
$stmt->execute();
$result = $stmt->get_result();

// Define o cabeçalho para o download do arquivo CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="horarios_disponiveis.csv"');

// Cria o arquivo CSV
$output = fopen('php://output', 'w');

// Adiciona os cabeçalhos ao CSV
fputcsv($output, ['ID', 'Data', 'Horário', 'Disponibilidade']);

// Adiciona os dados ao CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

// Fecha o arquivo
fclose($output);
exit();
?>
