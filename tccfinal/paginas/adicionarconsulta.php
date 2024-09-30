<?php
session_start(); // Inicie a sessão

$message = ''; // Inicializa a variável
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Limpa a mensagem após exibição
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tccdois";

// Criando conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obtendo todos os tutores da clínica
$tutores = [];
if (isset($_SESSION['clinica_id'])) {
    $clinica_id = $_SESSION['clinica_id'];
    $query = "SELECT id, nome FROM tutores WHERE clinica_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $clinica_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $tutores[] = $row;
    }
    $stmt->close();
}

// Obtendo datas e horários disponíveis
$disponibilidades = [];
if (isset($_SESSION['clinica_id'])) {
    $query = "SELECT CONCAT(data, ' ', horario) AS data_hora 
              FROM horarios 
              WHERE clinica_id = ? AND disponibilidade = 'Disponível'";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $clinica_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $disponibilidades[] = $row['data_hora'];
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fascinate+Inline&display=swap');
        body {
            background-image: url(https://img.freepik.com/free-vector/cat-lover-pattern-background-design_53876-100662.jpg?t=st=1727098307~exp=1727101907~hmac=71100b70a50679ff101ccace3876aa8ec8eff768f242ed477a284f39dcbc473f&w=1380);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex; 
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            display: flex;
            align-items: flex-start;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            width: 80%;
        }
        h2 {
            text-align: center;
            flex-basis: 100%;
        }
        .image-do-formulario {
            margin-right: 20px;
            width: 650px;
            height: auto;
        }
        .form-content {
            flex-grow: 1;
        }
        .input-group {
            margin-right: 40px;
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
        }
        .input-with-icon {
            position: relative;
        }
        .input-with-icon i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        .input-with-icon input,
        .input-with-icon select {
            width: 100%;
            padding: 10px 0px 10px 30px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .button-container {
            text-align: center;
        }
        .button-container button {
            padding: 10px 25px;
            background-color: #7c655c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .button-container button:hover {
            background-color: #45a049;
        }
        .titulo-cliente {
            font-size: 66px;
            font-weight: bold;
            font-family: "Fascinate Inline", system-ui;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
        }
        .message {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #dff0d8;
            color: #3c763d;
            padding: 15px 20px;
            border: 1px solid #d6e9c6;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none; /* Inicialmente escondido */
        }
    </style>
    <title>Adicionar Consulta</title>
</head>
<body>
<div class="message" id="message"><?php echo $message; ?></div>

<h1 class="titulo-cliente">Cadastro de Consulta</h1>
<div class="form-container">
    <img src="https://i.postimg.cc/SRpq5Bhf/10674932.jpg" class="image-do-formulario">
    <div class="form-content">
        <h2>Adicionar Consulta</h2>
        <form id="formAddConsultation" method="POST" action="salvar_consulta.php">
            <div class="input-group">
                <label for="nome_animal">Nome do Animal:</label>
                <div class="input-with-icon">
                    <i class='bx bx-paw'></i>
                    <input type="text" name="nome_animal" required>
                </div>
            </div>

            <div class="input-group">
                <label for="raca">Raça:</label>
                <div class="input-with-icon">
                    <i class='bx bx-paw'></i>
                    <input type="text" name="raca">
                </div>
            </div>

            <div class="input-group">
                <label for="proprietario">Proprietário:</label>
                <div class="input-with-icon">
                    <i class='bx bx-user'></i>
                    <select name="proprietario" required>
                        <option value="">Selecione o Proprietário</option>
                        <?php foreach ($tutores as $tutor): ?>
                            <option value="<?php echo $tutor['id']; ?>"><?php echo $tutor['nome']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <label for="data_hora_consulta">Data e Hora da Consulta:</label>
                <div class="input-with-icon">
                    <i class='bx bx-calendar'></i>
                    <select name="data_hora_consulta" required>
                        <option value="">Selecione Data e Hora</option>
                        <?php foreach ($disponibilidades as $disponibilidade): ?>
                            <option value="<?php echo $disponibilidade; ?>"><?php echo $disponibilidade; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="input-group">
                <label for="descricao">Descrição:</label>
                <div class="input-with-icon">
                    <i class='bx bx-comment'></i>
                    <textarea name="descricao" rows="4"></textarea>
                </div>
            </div>

            <div class="button-container">
                <button type="submit">Adicionar</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Exibe a mensagem se existir
    window.onload = function() {
        var messageElement = document.getElementById('message');
        if (messageElement.innerHTML.trim() !== '') {
            messageElement.style.display = 'block'; // Mostra a mensagem
            setTimeout(function() {
                messageElement.style.display = 'none'; // Esconde após 4 segundos
                window.location.href = 'agenda.php'; // Redireciona para outra página após 4 segundos
            }, 4000); // 4000 milissegundos = 4 segundos
        }
    };
</script>
</body>
</html>
