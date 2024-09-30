<?php
class Cliente
{
    private $idCliente;
    private $nome;
    private $email;
    private $telefone;
    private $endereco;
    private $cidade;
    private $estado;
    private $cep;
    private $clinica_id;

    // Métodos setters
    public function setIdCliente($valor) { $this->idCliente = $valor; }
    public function setNome($valor) { $this->nome = $valor; }
    public function setEmail($valor) { $this->email = $valor; }
    public function setTelefone($valor) { $this->telefone = $valor; }
    public function setEndereco($valor) { $this->endereco = $valor; }
    public function setCidade($valor) { $this->cidade = $valor; }
    public function setEstado($valor) { $this->estado = $valor; }
    public function setCep($valor) { $this->cep = $valor; }
    public function setClinicaId($valor) { $this->clinica_id = $valor; }

    // Métodos getters
    public function getIdCliente() { return $this->idCliente; }
    public function getNome() { return $this->nome; }
    public function getEmail() { return $this->email; }
    public function getTelefone() { return $this->telefone; }
    public function getEndereco() { return $this->endereco; }
    public function getCidade() { return $this->cidade; }
    public function getEstado() { return $this->estado; }
    public function getCep() { return $this->cep; }
    public function getClinicaId() { return $this->clinica_id; }

    // Método para listar clientes relacionados à clínica do veterinário logado
    public function listar($clinica_id)
    {
        require("conexaobd.php");

        // Verifica se a conexão foi estabelecida
        if (!isset($pdo)) {
            die("Erro: Conexão não estabelecida.");
        }

        // Consulta para listar apenas os clientes da clínica específica
        $consulta = "SELECT idCliente, nome, email, telefone, endereco, cidade, estado, cep, clinica_id 
                     FROM clientes 
                     WHERE clinica_id = :clinica_id 
                     ORDER BY nome;";
        $resultado = $pdo->prepare($consulta);
        $resultado->bindParam(":clinica_id", $clinica_id);
        $resultado->execute();

        return $resultado->fetchAll(PDO::FETCH_ASSOC); // Retorne todos os resultados como um array associativo
    }

    // Método para consultar um cliente específico
    public function consultar($idCliente)
    {
        require("conexaobd.php");

        // Verifica se a conexão foi estabelecida
        if (!isset($pdo)) {
            die("Erro: Conexão não estabelecida.");
        }

        $comando = "SELECT idCliente, nome, email, telefone, endereco, cidade, estado, cep, clinica_id 
                    FROM clientes 
                    WHERE idCliente = :idCliente";
        $resultado = $pdo->prepare($comando);
        $resultado->bindParam(":idCliente", $idCliente);
        $resultado->execute();

        if ($resultado->rowCount() == 1) {
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);
            $this->idCliente = $registro["idCliente"];
            $this->nome = $registro["nome"];
            $this->email = $registro["email"];
            $this->telefone = $registro["telefone"];
            $this->endereco = $registro["endereco"];
            $this->cidade = $registro["cidade"];
            $this->estado = $registro["estado"];
            $this->cep = $registro["cep"];
            $this->clinica_id = $registro["clinica_id"];
            return true;
        }
        return false;
    }
}
?>
