<?php
include('conexaobd.php');

if (isset($_GET['tutor_id'])) {
    $tutor_id = $_GET['tutor_id'];
    
    // Consulta os pets do tutor
    $sql = "SELECT id, nome FROM pets WHERE tutor_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$tutor_id]);
    $pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($pets);
} else {
    echo json_encode([]);
}
?>
