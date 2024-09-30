<?php
class Dashboard
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    // Método para obter o total de pacientes
    public function getTotalPacientes()
    {
        $consulta = "SELECT COUNT(*) FROM pacientes";
        $resultado = $this->conexao->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchColumn();
    }

    // Método para obter o total de tratamentos em andamento
    public function getTratamentosAndamento()
    {
        $consulta = "SELECT COUNT(*) FROM tratamentos WHERE status = 'Em Andamento'";
        $resultado = $this->conexao->prepare($consulta);
        $resultado->execute();
        return $resultado->fetchColumn();
    }

    // Método para obter o total de consultas hoje
    public function getConsultasHoje()
    {
        $dataHoje = date('Y-m-d');
        $consulta = "SELECT COUNT(*) FROM consultas_marcadas WHERE data_consulta = :dataHoje";
        $resultado = $this->conexao->prepare($consulta);
        $resultado->bindParam(':dataHoje', $dataHoje);
        $resultado->execute();
        return $resultado->fetchColumn();
    }
}
