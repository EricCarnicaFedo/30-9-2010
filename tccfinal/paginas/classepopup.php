<?php

class Popup {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para buscar um registro com base no ID e na tabela
    public function buscar($id, $tabela) {
        $stmt = $this->conn->prepare("SELECT * FROM $tabela WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Método para atualizar um registro
    public function atualizar($id, $dados, $tabela) {
        // Suponha que você tenha campos específicos na tabela
        $campos = '';
        foreach ($dados as $campo => $valor) {
            $campos .= "$campo = ?, ";
        }
        $campos = rtrim($campos, ', '); // Remove a última vírgula

        $stmt = $this->conn->prepare("UPDATE $tabela SET $campos WHERE id = ?");
        $dadosArray = array_values($dados);
        $dadosArray[] = $id; // Adiciona o ID ao final
        $stmt->bind_param(str_repeat('s', count($dadosArray) - 1) . 'i', ...$dadosArray);
        return $stmt->execute();
    }

    // Método para deletar um registro
    public function deletar($id, $tabela) {
        $stmt = $this->conn->prepare("DELETE FROM $tabela WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}

?>
