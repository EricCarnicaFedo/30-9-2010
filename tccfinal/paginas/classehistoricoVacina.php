<?php
class HistoricoVacina
{
    private $idHistorico;
    private $idAnimal;
    private $nomeAnimal;
    private $idVacina;
    private $nomeVacina;
    private $dataAplicacao;
    private $veterinario;

    // Métodos setters
    public function setIdHistorico($valor) {
        $this->idHistorico = $valor;
    }

    public function setIdAnimal($valor) {
        $this->idAnimal = $valor;
    }

    public function setIdVacina($valor) {
        $this->idVacina = $valor;
    }

    public function setDataAplicacao($valor) {
        $this->dataAplicacao = $valor;
    }

    public function setVeterinario($valor) {
        $this->veterinario = $valor;
    }

    // Métodos getters
    public function getIdHistorico() {
        return $this->idHistorico;
    }

    public function getIdAnimal() {
        return $this->idAnimal;
    }

    public function getIdVacina() {
        return $this->idVacina;
    }

    public function getDataAplicacao() {
        return $this->dataAplicacao;
    }

    public function getVeterinario() {
        return $this->veterinario;
    }

    // Listar todo o histórico de vacinas
    public function listar() {
        require("conexaobd.php");
    
        $consulta = "SELECT hv.idHistorico, p.nome AS nomeAnimal, v.nomeVacina, hv.dataAplicacao, hv.veterinario
                     FROM historico_vacinas hv
                     JOIN pets p ON hv.idAnimal = p.id
                     JOIN vacinas v ON hv.idVacina = v.idVacina
                     ORDER BY hv.dataAplicacao";
        $resultado = $pdo->prepare($consulta);
        $resultado->execute();
    
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    // Consultar um histórico específico
    public function consultar($idHistorico) {
        require("conexaobd.php");
    
        $comando = "SELECT hv.idHistorico, p.nome AS nomeAnimal, v.nomeVacina, hv.dataAplicacao, hv.veterinario
                    FROM historico_vacinas hv
                    JOIN pets p ON hv.idAnimal = p.id
                    JOIN vacinas v ON hv.idVacina = v.idVacina
                    WHERE hv.idHistorico = :idHistorico";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(":idHistorico", $idHistorico);
        $resultado->execute();
    
        if ($resultado->rowCount() == 1) {
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);
            $this->idHistorico = $registro["idHistorico"];
            $this->nomeAnimal = $registro["nomeAnimal"];
            $this->nomeVacina = $registro["nomeVacina"];
            $this->dataAplicacao = $registro["dataAplicacao"];
            $this->veterinario = $registro["veterinario"];
            return true;
        }
        return false;
    }

    // Inserir um novo histórico de vacina
    public function inserir($idAnimal, $idVacina, $dataAplicacao, $veterinario) {
        require("conexaobd.php");

        $comando = "INSERT INTO historico_vacinas (idAnimal, idVacina, dataAplicacao, veterinario) 
                    VALUES (:idAnimal, :idVacina, :dataAplicacao, :veterinario)";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(':idAnimal', $idAnimal);
        $resultado->bindParam(':idVacina', $idVacina);
        $resultado->bindParam(':dataAplicacao', $dataAplicacao);
        $resultado->bindParam(':veterinario', $veterinario);
        $resultado->execute();

        return ($resultado->rowCount() == 1) ? true : false;
    }

    // Alterar um histórico de vacina existente
    public function alterar($idHistorico, $idAnimal, $idVacina, $dataAplicacao, $veterinario) {
        require("conexaobd.php");

        $comando = "UPDATE historico_vacinas 
                    SET idAnimal = :idAnimal, idVacina = :idVacina, 
                        dataAplicacao = :dataAplicacao, veterinario = :veterinario 
                    WHERE idHistorico = :idHistorico";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(':idHistorico', $idHistorico);
        $resultado->bindParam(':idAnimal', $idAnimal);
        $resultado->bindParam(':idVacina', $idVacina);
        $resultado->bindParam(':dataAplicacao', $dataAplicacao);
        $resultado->bindParam(':veterinario', $veterinario);
        $resultado->execute();

        return ($resultado->rowCount() == 1) ? true : false;
    }

    // Excluir um histórico de vacina
    public function excluir($idHistorico) {
        require("conexaobd.php");

        $comando = "DELETE FROM historico_vacinas WHERE idHistorico = :idHistorico";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(':idHistorico', $idHistorico);
        $resultado->execute();

        return ($resultado->rowCount() == 1) ? true : false;
    }
}
?>
