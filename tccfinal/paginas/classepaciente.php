<?php
class Paciente
{
    private $idPaciente;
    private $nomeAnimal;
    private $especie;
    private $raca;
    private $idade;
    private $sexo;
    private $dataNascimento;
    private $nomeDono;
    private $telefoneDono;
    private $emailDono;
    private $enderecoDono;
    private $cidadeDono;
    private $estadoDono;
    private $cepDono;
    private $idTutor;

    // Métodos setters
    public function setIdPaciente($valor) {
        $this->idPaciente = $valor;
    }

    public function setNomeAnimal($valor) {
        $this->nomeAnimal = $valor;
    }

    public function setEspecie($valor) {
        $this->especie = $valor;
    }

    public function setRaca($valor) {
        $this->raca = $valor;
    }

    public function setIdade($valor) {
        $this->idade = $valor;
    }

    public function setSexo($valor) {
        $this->sexo = $valor;
    }

    public function setDataNascimento($valor) {
        $this->dataNascimento = $valor;
    }

    public function setNomeDono($valor) {
        $this->nomeDono = $valor;
    }

    public function setTelefoneDono($valor) {
        $this->telefoneDono = $valor;
    }

    public function setEmailDono($valor) {
        $this->emailDono = $valor;
    }

    public function setEnderecoDono($valor) {
        $this->enderecoDono = $valor;
    }

    public function setCidadeDono($valor) {
        $this->cidadeDono = $valor;
    }

    public function setEstadoDono($valor) {
        $this->estadoDono = $valor;
    }

    public function setCepDono($valor) {
        $this->cepDono = $valor;
    }

    public function setIdTutor($valor) {
        $this->idTutor = $valor;
    }

    // Métodos getters
    public function getIdPaciente() {
        return $this->idPaciente;
    }

    public function getNomeAnimal() {
        return $this->nomeAnimal;
    }

    public function getEspecie() {
        return $this->especie;
    }

    public function getRaca() {
        return $this->raca;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getDataNascimento() {
        return $this->dataNascimento;
    }

    public function getNomeDono() {
        return $this->nomeDono;
    }

    public function getTelefoneDono() {
        return $this->telefoneDono;
    }

    public function getEmailDono() {
        return $this->emailDono;
    }

    public function getEnderecoDono() {
        return $this->enderecoDono;
    }

    public function getCidadeDono() {
        return $this->cidadeDono;
    }

    public function getEstadoDono() {
        return $this->estadoDono;
    }

    public function getCepDono() {
        return $this->cepDono;
    }

    public function getIdTutor() {
        return $this->idTutor;
    }

    // Método para listar pacientes
    
    public function listar()
    {
        require("conexaobd.php");

        $consulta = "SELECT id, nome, especie, raca, idade, tutor_id, sexo FROM pacientes";
        $resultado = $pdo->prepare($consulta);
        $resultado->execute();

        $pacientes = $resultado->fetchAll(PDO::FETCH_ASSOC);

        return $pacientes; // Retorna os pacientes para serem usados onde necessário
    }

    

    // Método para consultar um paciente pelo ID
    public function consultar($idPaciente)
    {
        require("conexaobd.php");

        $consulta = "SELECT * FROM pacientes WHERE id = :idPaciente";
        $resultado = $pdo->prepare($consulta);
        $resultado->bindParam(':idPaciente', $idPaciente, PDO::PARAM_INT);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    // Adicione outros métodos para inserir, atualizar e excluir conforme necessário
}
?>
