<?php
class Tutor
{
    private $pdo; // Adiciona a propriedade PDO
    private $id; 
    private $nome;
    private $email;
    private $telefone; // Se não estiver na tabela, remova
    private $endereco; // Se não estiver na tabela, remova
    private $cidade; // Se não estiver na tabela, remova
    private $estado; // Se não estiver na tabela, remova
    private $cep; // Se não estiver na tabela, remova

    // Construtor para inicializar a conexão PDO
    public function __construct() {
        try {
            // Altere para suas credenciais de banco de dados
            $this->pdo = new PDO("mysql:host=localhost;dbname=seu_banco_de_dados", "usuario", "senha");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Métodos setters
    public function setId($valor) {
        $this->id = $valor;
    }

    public function setNome($valor) {
        $this->nome = $valor;
    }

    public function setEmail($valor) {
        $this->email = $valor;
    }

    // Outros setters podem ser removidos se não forem usados

    // Métodos getters
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    // Outros getters podem ser removidos se não forem usados

    // Listar todos os tutores
    public function listar() {
        $query = "SELECT id, nome, email, telefone, cidade, estado, cep FROM tutores"; // Remova 'endereco' se não existir
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Consultar um tutor específico
    public function consultar($id) {
        $comando = "SELECT id, nome, email FROM tutores WHERE id = :id"; 
        $resultado = $this->pdo->prepare($comando); // Use $this->pdo
        $resultado->bindParam(':id', $id);
        $resultado->execute();

        return $resultado->fetch(PDO::FETCH_ASSOC);
    }

    // Inserir um novo tutor
    public function inserir() {
        $comando = "INSERT INTO tutores (nome, email) VALUES (:nome, :email)";
        $resultado = $this->pdo->prepare($comando); // Use $this->pdo

        $resultado->bindParam(':nome', $this->nome);
        $resultado->bindParam(':email', $this->email);

        return $resultado->execute();
    }

    // Alterar um tutor existente
    public function alterar() {
        $comando = "UPDATE tutores SET nome = :nome, email = :email WHERE id = :id"; 
        $resultado = $this->pdo->prepare($comando); // Use $this->pdo

        $resultado->bindParam(':id', $this->id);
        $resultado->bindParam(':nome', $this->nome);
        $resultado->bindParam(':email', $this->email);

        return $resultado->execute();
    }

    // Excluir um tutor
    public function excluir($id) {
        $comando = "DELETE FROM tutores WHERE id = :id"; 
        $resultado = $this->pdo->prepare($comando); // Use $this->pdo
        $resultado->bindParam(':id', $id);

        return $resultado->execute();
    }
}
