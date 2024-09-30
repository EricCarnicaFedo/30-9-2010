<?php
session_start();

$message = '';
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
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

// Recuperando tutores
$tutoresQuery = "SELECT id, nome FROM tutores";
$tutoresResult = $conn->query($tutoresQuery);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.1/css/boxicons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fascinate+Inline&display=swap');
        body {
            background-image: url(https://img.freepik.com/free-vector/cat-lover-pattern-background-design_53876-100662.jpg);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
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
        .form-group {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .input-group {
            flex: 1 1 45%; /* Ajusta a largura dos campos */
            margin-right: 10px;
        }
        .input-group:last-child {
            margin-right: 0; /* Remove a margem do último item */
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
        .titulo-paciente {
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
    <title>Adicionar Paciente</title>
</head>
<body>
<div class="message" id="message"><?php echo $message; ?></div>

<h1 class="titulo-paciente">Cadastro de Paciente</h1>
<div class="form-container">
    <img src="https://i.postimg.cc/MGynk9Fp/2126918.jpg" class="image-do-formulario">
    <div class="form-content">
        <h2>Adicionar Paciente</h2>
        <form id="formAddPaciente" method="POST" action="salvar_paciente.php">
            <div class="form-group">
                <div class="input-group">
                    <label for="nomeAnimal">Nome do Animal:</label>
                    <div class="input-with-icon">
                        <i class='bx bx-paw'></i>
                        <input type="text" name="nomeAnimal" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="especie">Espécie:</label>
                    <div class="input-with-icon">
                        <i class='bx bx-paw'></i>
                        <input type="text" name="especie" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <label for="raca">Raça:</label>
                    <div class="input-with-icon">
                        <i class='bx bx-paw'></i>
                        <input type="text" name="raca" required>
                    </div>
                </div>

                <div class="input-group">
                    <label for="idade">Idade:</label>
                    <div class="input-with-icon">
                        <i class='bx bx-time-five'></i>
                        <input type="number" name="idade" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <label for="sexo">Sexo:</label>
                    <div class="input-with-icon">
                        <select name="sexo" required>
                            <option value="Macho">Macho</option>
                            <option value="Fêmea">Fêmea</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <label for="dataNascimento">Data de Nascimento:</label>
                    <div class="input-with-icon">
                        <i class='bx bx-calendar'></i>
                        <input type="date" name="dataNascimento" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <label for="tutor">Selecionar Tutor:</label>
                    <div class="input-with-icon">
                        <i class='bx bx-user'></i>
                        <select name="tutor" id="tutor" required onchange="carregarDadosTutor(this.value)">
                            <option value="">Selecione um Tutor</option>
                            <?php if ($tutoresResult->num_rows > 0): ?>
                                <?php while ($tutor = $tutoresResult->fetch_assoc()): ?>
                                    <option value="<?php echo $tutor['id']; ?>"><?php echo $tutor['nome']; ?></option>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div id="dadosTutor" style="display: none;">
                <div class="form-group">
                    <div class="input-group">
                        <label for="telefoneDono">Telefone do Dono:</label>
                        <div class="input-with-icon">
                            <i class='bx bx-phone'></i>
                            <input type="text" id="telefoneDono" name="telefoneDono" readonly>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="emailDono">Email do Dono:</label>
                        <div class="input-with-icon">
                            <i class='bx bx-envelope'></i>
                            <input type="email" id="emailDono" name="emailDono" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <label for="enderecoDono">Endereço do Dono:</label>
                        <div class="input-with-icon">
                            <i class='bx bx-home'></i>
                            <input type="text" id="enderecoDono" name="enderecoDono" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-container">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function carregarDadosTutor(tutorId) {
        if (tutorId) {
            fetch(`carregar_dados_tutor.php?id=${tutorId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('telefoneDono').value = data.telefone;
                    document.getElementById('emailDono').value = data.email;
                    document.getElementById('enderecoDono').value = data.endereco;
                    document.getElementById('dadosTutor').style.display = 'block'; // Exibe os dados do tutor
                })
                .catch(error => console.error('Erro ao carregar dados do tutor:', error));
        } else {
            document.getElementById('dadosTutor').style.display = 'none'; // Esconde se nenhum tutor for selecionado
        }
    }

   // Exibe a mensagem se existir
window.onload = function() {
    var messageElement = document.getElementById('message');
    if (messageElement.innerHTML.trim() !== '') {
        messageElement.style.display = 'block'; // Mostra a mensagem
        setTimeout(function() {
            messageElement.style.display = 'none'; // Esconde após 4 segundos
            window.location.href = 'pets.php'; // Redireciona para outra página após 4 segundos
        }, 4000);
    }
};

</script>
</body>
</html>

<?php
$conn->close();
?>
