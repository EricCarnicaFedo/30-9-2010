<?php
class Tratamento
{
    private $idTratamento;
    private $nomeAnimal;
    private $descricao;
    private $dataInicio;
    private $dataFim;
    private $status;

    // Métodos setters
    public function setIdTratamento($valor) {
        $this->idTratamento = $valor;
    }

    public function setNomeAnimal($valor) {
        $this->nomeAnimal = $valor;
    }

    public function setDescricao($valor) {
        $this->descricao = $valor;
    }

    public function setDataInicio($valor) {
        $this->dataInicio = $valor;
    }

    public function setDataFim($valor) {
        $this->dataFim = $valor;
    }

    public function setStatus($valor) {
        $this->status = $valor;
    }

    // Métodos getters
    public function getIdTratamento() {
        return $this->idTratamento;
    }

    public function getNomeAnimal() {
        return $this->nomeAnimal;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getDataInicio() {
        return $this->dataInicio;
    }

    public function getDataFim() {
        return $this->dataFim;
    }

    public function getStatus() {
        return $this->status;
    }

    // Listar todos os tratamentos
    public function listar() {
        require("conexaobd.php");
    
        try {
            $consulta = "SELECT * FROM tratamentos";
            $resultado = $pdo->prepare($consulta);
            $resultado->execute();
    
            return $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Em caso de erro, exibir ou registrar o erro
            echo "Erro ao listar tratamentos: " . $e->getMessage();
            return false;
        }
    }
    

    // Consultar um tratamento específico
    public function consultar($idTratamento) {
        require("conexaobd.php");

        $comando = "SELECT * FROM tratamentos WHERE idTratamento = :idTratamento";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(":idTratamento", $idTratamento);
        $resultado->execute();

        if ($resultado->rowCount() == 1) {
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);
            $this->idTratamento = $registro["idTratamento"];
            $this->nomeAnimal = $registro["nomeAnimal"];
            $this->descricao = $registro["descricao"];
            $this->dataInicio = $registro["dataInicio"];
            $this->dataFim = $registro["dataFim"];
            $this->status = $registro["status"];
            return true;
        }
        return false;
    }

    // Inserir um novo tratamento
    public function inserir($nomeAnimal, $descricao, $dataInicio, $dataFim, $status) {
        require("conexaobd.php");
    
        try {
            $comando = "INSERT INTO tratamentos (nomeAnimal, descricao, dataInicio, dataFim, status) 
                        VALUES (:nomeAnimal, :descricao, :dataInicio, :dataFim, :status)";
            $resultado = $pdo->prepare($comando);
            $resultado->bindParam(':nomeAnimal', $nomeAnimal);
            $resultado->bindParam(':descricao', $descricao);
            $resultado->bindParam(':dataInicio', $dataInicio);
            $resultado->bindParam(':dataFim', $dataFim);
            $resultado->bindParam(':status', $status);
            $resultado->execute();
    
            return ($resultado->rowCount() == 1);
        } catch (PDOException $e) {
            // Em caso de erro, exibir ou registrar o erro
            echo "Erro ao inserir tratamento: " . $e->getMessage();
            return false;
        }
    }
    

    // Alterar um tratamento existente
    public function alterar($idTratamento, $nomeAnimal, $descricao, $dataInicio, $dataFim, $status) {
        require("conexaobd.php");

        $comando = "UPDATE tratamentos 
                    SET nomeAnimal = :nomeAnimal, descricao = :descricao, 
                        dataInicio = :dataInicio, dataFim = :dataFim, status = :status 
                    WHERE idTratamento = :idTratamento";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(':idTratamento', $idTratamento);
        $resultado->bindParam(':nomeAnimal', $nomeAnimal);
        $resultado->bindParam(':descricao', $descricao);
        $resultado->bindParam(':dataInicio', $dataInicio);
        $resultado->bindParam(':dataFim', $dataFim);
        $resultado->bindParam(':status', $status);
        $resultado->execute();

        return ($resultado->rowCount() == 1) ? true : false;
    }

    // Excluir um tratamento
    public function excluir($idTratamento) {
        require("conexaobd.php");

        $comando = "DELETE FROM tratamentos WHERE idTratamento = :idTratamento";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(':idTratamento', $idTratamento);
        $resultado->execute();

        return ($resultado->rowCount() == 1) ? true : false;
    }
}