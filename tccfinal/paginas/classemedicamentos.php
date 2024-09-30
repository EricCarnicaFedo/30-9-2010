<?php
class Medicamento
{
    private $idPrescricao;
    private $nomeAnimal;
    private $medicamento;
    private $dataPrescricao;
    private $dosagem;

    // Métodos setters
    public function setIdPrescricao($valor) {
        $this->idPrescricao = $valor;
    }

    public function setNomeAnimal($valor) {
        $this->nomeAnimal = $valor;
    }

    public function setMedicamento($valor) {
        $this->medicamento = $valor;
    }

    public function setDataPrescricao($valor) {
        $this->dataPrescricao = $valor;
    }

    public function setDosagem($valor) {
        $this->dosagem = $valor;
    }

    // Métodos getters
    public function getIdPrescricao() {
        return $this->idPrescricao;
    }

    public function getNomeAnimal() {
        return $this->nomeAnimal;
    }

    public function getMedicamento() {
        return $this->medicamento;
    }

    public function getDataPrescricao() {
        return $this->dataPrescricao;
    }

    public function getDosagem() {
        return $this->dosagem;
    }

    // Listar todos os medicamentos prescritos
    public function listar() {
        require("conexaobd.php");

        $consulta = "SELECT * FROM medicamentos_prescritos ORDER BY dataPrescricao";
        $resultado = $pdo->prepare($consulta);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    // Consultar um medicamento específico
    public function consultar($idPrescricao) {
        require("conexaobd.php");

        $comando = "SELECT * FROM medicamentos_prescritos WHERE idPrescricao = :idPrescricao";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(":idPrescricao", $idPrescricao);
        $resultado->execute();

        if ($resultado->rowCount() == 1) {
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);
            $this->idPrescricao = $registro["idPrescricao"];
            $this->nomeAnimal = $registro["nomeAnimal"];
            $this->medicamento = $registro["medicamento"];
            $this->dataPrescricao = $registro["dataPrescricao"];
            $this->dosagem = $registro["dosagem"];
            return true;
        }
        return false;
    }

    // Inserir um novo medicamento prescrito
    public function inserir($nomeAnimal, $medicamento, $dataPrescricao, $dosagem) {
        require("conexaobd.php");

        $comando = "INSERT INTO medicamentos_prescritos (nomeAnimal, medicamento, dataPrescricao, dosagem) 
                    VALUES (:nomeAnimal, :medicamento, :dataPrescricao, :dosagem)";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(':nomeAnimal', $nomeAnimal);
        $resultado->bindParam(':medicamento', $medicamento);
        $resultado->bindParam(':dataPrescricao', $dataPrescricao);
        $resultado->bindParam(':dosagem', $dosagem);
        $resultado->execute();

        return ($resultado->rowCount() == 1) ? true : false;
    }

    // Alterar um medicamento prescrito existente
    public function alterar($idPrescricao, $nomeAnimal, $medicamento, $dataPrescricao, $dosagem) {
        require("conexaobd.php");

        $comando = "UPDATE medicamentos_prescritos 
                    SET nomeAnimal = :nomeAnimal, medicamento = :medicamento, 
                        dataPrescricao = :dataPrescricao, dosagem = :dosagem 
                    WHERE idPrescricao = :idPrescricao";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(':idPrescricao', $idPrescricao);
        $resultado->bindParam(':nomeAnimal', $nomeAnimal);
        $resultado->bindParam(':medicamento', $medicamento);
        $resultado->bindParam(':dataPrescricao', $dataPrescricao);
        $resultado->bindParam(':dosagem', $dosagem);
        $resultado->execute();

        return ($resultado->rowCount() == 1) ? true : false;
    }

    // Excluir um medicamento prescrito
    public function excluir($idPrescricao) {
        require("conexaobd.php");

        $comando = "DELETE FROM medicamentos_prescritos WHERE idPrescricao = :idPrescricao";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(':idPrescricao', $idPrescricao);
        $resultado->execute();

        return ($resultado->rowCount() == 1) ? true : false;
    }
}

