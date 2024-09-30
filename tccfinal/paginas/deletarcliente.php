<?php
include('conexaobd.php');
session_start();

// Verifica se o usuário está logado e é um veterinário
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] != 'veterinario') {
    header("Location: login.php");
    exit();
}

// Obtém o ID do cliente a ser deletado
if (isset($_GET['id'])) {
    $cliente_id = $_GET['id'];
    
    try {
        // Deleta o cliente
        $sql = "DELETE FROM clientes WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $cliente_id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Redireciona de volta para a lista de clientes
        header("Location: agenda.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao deletar cliente: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "ID do cliente não fornecido.";
}
?>
