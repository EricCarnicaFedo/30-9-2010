<?php
require("classe.php"); // A classe que vai gerenciar as operações do banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $tabela = $_POST['tabela'];

    $dados = [];
    foreach ($_POST as $campo => $valor) {
        if ($campo != 'id' && $campo != 'tabela') {
            $dados[$campo] = $valor;
        }
    }

    $objeto = new Classe();
    $objeto->atualizarRegistro($id, $tabela, $dados); // Método que atualiza o registro no banco de dados

    header("Location: tabela.php?tabela=$tabela"); // Redireciona para a tabela correspondente
    exit;
}
