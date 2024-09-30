<?php
include 'conexaobd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tabela = $_POST['tabela'];
    
    try {
        switch ($tabela) {
            case 'pacientes':
                $nomeAnimal = isset($_POST['field1']) ? $_POST['field1'] : null;
                $raca = isset($_POST['field2']) ? $_POST['field2'] : null;
                $nomeDono = isset($_POST['field3']) ? $_POST['field3'] : null;
                $dataNascimento = isset($_POST['field4']) ? $_POST['field4'] : null;
                $idade = isset($_POST['field5']) ? $_POST['field5'] : null;
                $sexo = isset($_POST['field6']) ? $_POST['field6'] : null;

                if (empty($nomeDono)) {
                    throw new Exception("O campo 'Proprietário' não pode ser vazio.");
                }

                $sql = "INSERT INTO pacientes (nome, raca, proprietario, dataNascimento, idade, sexo) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conexao->prepare($sql);
                $stmt->execute([$nomeAnimal, $raca, $nomeDono, $dataNascimento, $idade, $sexo]);

                echo "<script>showMessage('success', 'Dados inseridos com sucesso!');</script>";
                break;

            case 'exames_realizados':
                $nomeAnimal = isset($_POST['field1']) ? $_POST['field1'] : null;
                $tipoExame = isset($_POST['field2']) ? $_POST['field2'] : null;
                $dataExame = isset($_POST['field3']) ? $_POST['field3'] : null;
                $resultado = isset($_POST['field4']) ? $_POST['field4'] : null;

                $sql = "INSERT INTO exames_realizados (nomeAnimal, tipoExame, dataExame, resultado) VALUES (?, ?, ?, ?)";
                $stmt = $conexao->prepare($sql);
                $stmt->execute([$nomeAnimal, $tipoExame, $dataExame, $resultado]);

                echo "<script>showMessage('success', 'Exame inserido com sucesso!');</script>";
                break;

            case 'medicamentos_prescritos':
                $nomeAnimal = isset($_POST['field1']) ? $_POST['field1'] : null;
                $medicamento = isset($_POST['field2']) ? $_POST['field2'] : null;
                $dataPrescricao = isset($_POST['field3']) ? $_POST['field3'] : null;
                $dosagem = isset($_POST['field4']) ? $_POST['field4'] : null;

                $sql = "INSERT INTO medicamentos_prescritos (nomeAnimal, medicamento, dataPrescricao, dosagem) VALUES (?, ?, ?, ?)";
                $stmt = $conexao->prepare($sql);
                $stmt->execute([$nomeAnimal, $medicamento, $dataPrescricao, $dosagem]);

                echo "<script>showMessage('success', 'Medicamento inserido com sucesso!');</script>";
                break;

            case 'tutores':
                $idTutor = isset($_POST['field1']) ? $_POST['field1'] : null;
                $nomeTutor = isset($_POST['field2']) ? $_POST['field2'] : null;
                $email = isset($_POST['field3']) ? $_POST['field3'] : null;
                $telefone = isset($_POST['field4']) ? $_POST['field4'] : null;
                $endereco = isset($_POST['field5']) ? $_POST['field5'] : null;
                $cidade = isset($_POST['field6']) ? $_POST['field6'] : null;
                $estado = isset($_POST['field7']) ? $_POST['field7'] : null;
                $cep = isset($_POST['field8']) ? $_POST['field8'] : null;

                $sql = "INSERT INTO tutores (idTutor, nomeTutor, email, telefone, endereco, cidade, estado, cep) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conexao->prepare($sql);
                $stmt->execute([$idTutor, $nomeTutor, $email, $telefone, $endereco, $cidade, $estado, $cep]);

                echo "<script>showMessage('success', 'Tutor inserido com sucesso!');</script>";
                break;

            case 'tratamentos':
                $nomeAnimal = isset($_POST['field1']) ? $_POST['field1'] : null;
                $tipoTratamento = isset($_POST['field2']) ? $_POST['field2'] : null;
                $dataTratamento = isset($_POST['field3']) ? $_POST['field3'] : null;
                $resultado = isset($_POST['field4']) ? $_POST['field4'] : null;
                $status = isset($_POST['field5']) ? $_POST['field5'] : null;

                $sql = "INSERT INTO tratamentos (nomeAnimal, tipoTratamento, dataTratamento, resultado, status) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conexao->prepare($sql);
                $stmt->execute([$nomeAnimal, $tipoTratamento, $dataTratamento, $resultado, $status]);

                echo "<script>showMessage('success', 'Tratamento inserido com sucesso!');</script>";
                break;
                
                case 'historico_vacinas':
                    $idAnimal = isset($_POST['idAnimal']) ? $_POST['idAnimal'] : null;
                    $idVacina = isset($_POST['idVacina']) ? $_POST['idVacina'] : null;
                    $dataAplicacao = isset($_POST['dataAplicacao']) ? $_POST['dataAplicacao'] : null;
                    $veterinario = isset($_POST['veterinario']) ? $_POST['veterinario'] : null;
                
                    if (empty($idAnimal) || empty($idVacina) || empty($dataAplicacao) || empty($veterinario)) {
                        throw new Exception("Todos os campos devem ser preenchidos.");
                    }
                
                    $sql = "INSERT INTO historico_vacinas (idAnimal, idVacina, dataAplicacao, veterinario) VALUES (?, ?, ?, ?)";
                    $stmt = $conexao->prepare($sql);
                    $stmt->execute([$idAnimal, $idVacina, $dataAplicacao, $veterinario]);
                
                    echo "<script>showMessage('success', 'Vacina registrada com sucesso!');</script>";
                    break;
                

            case 'consultas_marcadas':
                $nomeAnimal = isset($_POST['field1']) ? $_POST['field1'] : null;
                $raca = isset($_POST['field2']) ? $_POST['field2'] : null;
                $proprietario = isset($_POST['field3']) ? $_POST['field3'] : null;
                $dataConsulta = isset($_POST['field4']) ? $_POST['field4'] : null;
                $horaConsulta = isset($_POST['field5']) ? $_POST['field5'] : null;
                $status = isset($_POST['field6']) ? $_POST['field6'] : null;

                $sql = "INSERT INTO consultas_marcadas (nomeAnimal, raca, proprietario, dataConsulta, horaConsulta, status) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conexao->prepare($sql);
                $stmt->execute([$nomeAnimal, $raca, $proprietario, $dataConsulta, $horaConsulta, $status]);

                echo "<script>showMessage('success', 'Consulta marcada com sucesso!');</script>";
                break;

            case 'estado':
                $sigla = isset($_POST['field1']) ? $_POST['field1'] : null;
                $nome = isset($_POST['field2']) ? $_POST['field2'] : null;

                $sql = "INSERT INTO estado (sigla, nome) VALUES (?, ?)";
                $stmt = $conexao->prepare($sql);
                $stmt->execute([$sigla, $nome]);

                echo "<script>showMessage('success', 'Estado inserido com sucesso!');</script>";
                break;

            default:
                throw new Exception("Tabela não reconhecida.");
        }
    } catch (Exception $e) {
        echo "<script>showMessage('error', 'Erro ao inserir dados: " . $e->getMessage() . "');</script>";
    }
}
