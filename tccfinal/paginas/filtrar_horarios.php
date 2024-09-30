<?php
session_start();
require("classehorarios.php");

$horario = new Horarios();  

$estado = isset($_GET['estado']) ? $_GET['estado'] : null;
$dataDesde = isset($_GET['desde']) ? $_GET['desde'] : null;
$dataAte = isset($_GET['ate']) ? $_GET['ate'] : null;

$horariosDisponiveis = $horario->listar($_SESSION['clinica_id'], $estado, $dataDesde, $dataAte);

echo json_encode($horariosDisponiveis);
?>
