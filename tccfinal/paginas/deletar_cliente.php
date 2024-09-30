<?php
$conn = new mysqli('localhost', 'root', '', 'tccdois');

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $idCliente = $_GET['id'];

    // Verifica se o cliente pode ser deletado
    $sql = "DELETE FROM clientes WHERE idCliente = '$idCliente'";

    if ($conn->query($sql) === TRUE) {
        echo "Cliente deletado com sucesso!";
    } else {
        echo "Erro ao deletar cliente: " . $conn->error;
    }
} else {
    echo "ID do cliente não especificado.";
}

$conn->close();

// Redirecionar após a operação
header("Location: agenda.php"); // Substitua pelo caminho da sua página de clientes
exit();
?>
