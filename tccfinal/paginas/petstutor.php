<?php
session_start(); // Inicia a sessão

// Verificar se o 'tutor_id' está definido na sessão
if (!isset($_SESSION['tutor_id'])) {
    
    die("Erro: tutor_id não definido. Por favor, faça login para acessar essa página.");
}

// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tcctres";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Inicializar a variável $pets como um array vazio
$pets = [];

// ID do tutor
$tutor_id = $_SESSION['tutor_id']; // O tutor_id está agora garantido como definido

// Preparar a consulta
$sql = "SELECT nome, especie, raca, idade FROM pets WHERE tutor_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $tutor_id);

// Executar a consulta
$stmt->execute();

// Obter o resultado
$result = $stmt->get_result();

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pets[] = $row;
        }
    } else {
        echo "Nenhum pet encontrado para este tutor.";
    }
} else {
    echo "Erro na consulta: " . $conn->error;
}

// Fechar a declaração e a conexão
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!----======== CSS ======== -->
  <link rel="stylesheet" href="tutor.css">
  <link rel="stylesheet" href="inicio.css">
  <link rel="stylesheet" href="style.css">

  <!---------========= fontes =========------->
  <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

  <style>
       

        h1 {
            color: #333;
            margin: 20px 0;
        }

        /* Container principal */
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-bottom:400px;
        }

        /* Card dos pets */
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 250px;
            text-align: center;
            padding: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card i {
            font-size: 50px;
            color: #6c63ff;
        }

        .card h3 {
            margin: 15px 0;
            font-size: 1.2em;
            color: #333;
        }

        .card p {
            color: #666;
            font-size: 0.9em;
            line-height: 1.4;
        }

        .card .btn-details {
            background-color: #6c63ff;
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        .card .btn-details:hover {
            background-color: #5145d3;
        }

        /* Botão de adicionar pet */
        .add-card {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            border: 2px dashed #6c63ff;
            border-radius: 10px;
            width: 250px;
            height: 250px;
            cursor: pointer;
            transition: background-color 0.3s, border 0.3s;
        }

        .add-card:hover {
            background-color: #e2e3ff;
            border-color: #5145d3;
        }

        .add-card i {
            font-size: 70px;
            color: #6c63ff;
        }

        /* Estilos da ficha do pet */
        .ficha-container {
          display: none; /* Ocultar por padrão */
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 

            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px; 
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 60%;
            max-width: 800px;
            padding: 20px;
            margin: 400px ;
            display: none;
            flex-direction: column;
            transition: all 0.3s fade-in; /* Transição suave */
            
        }

        .ficha-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #6c63ff;
            padding-bottom: 10px;
        }

        .ficha-header h2 {
  margin: 0;
  font-size: 1.5em;
  color: #333;
  text-align: center; /* add this line to center the text horizontally */
}

        .ficha-header button {
            background-color: #ff5e5e;
            border: none;
            color: #fff;
            padding: 10px 15px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        .ficha-header button:hover {
            background-color: #e04848;
        }

        .ficha-content {
            font-size: 1em;
            line-height: 1.6;
            color: #666;
            margin-top: 15px;
        }

        .ficha-content strong {
            color: #333;
        }

        .ficha-content ul {
            list-style-type: square;
            padding-left: 20px;
        }

        /* Estilos do modal */
        .modal {
            display: none; /* Ocultar por padrão */
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px; 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            max-width: 500px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Estilos do formulário */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"],
        input[type="number"] {
          width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #6c63ff;
            outline: none;
        }

        button[type="submit"] {
            background-color: #6c63ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #5145d3;
        }
        .modal-content h2 {
  text-align: center;
  font-size: 24px;
}
    </style>
</head>

<header id="navbar" class="flex justify-between items-center text-white p-4">
  <nav>
    <div class="titulonavbar">
      <i class="bx bxs-animal-paw"></i>
      <span class="text">Meus Pets</span>
    </div>
    <ul class="navbarconteudo">
      <!-- Manter apenas os itens desejados -->
    </ul>
  </nav>

  <div class="flex items-center space-x-4">
    <span class="hidden md:inline-block">Bem-vindo, <?php echo isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : 'Usuário'; ?></span>
    <a href="logout.php" class="hover:underline">Sair</a>
    <i class="bx bx-bell"></i>
    <img src="https://placehold.co/30x30" alt="User avatar" class="w-8 h-8 rounded-full">
  </div>

  <i class='bx bx-menu menu-button' id="menu-button" style="font-size: 30px;"></i>
  <i class='bx bx-cog customize-button' id="customize-button" style="font-size: 20px;"></i>
  <div id="color-picker">
    <label for="navbar-color">Escolha a cor da navbar:</label>
    <input type="color" id="navbar-color" name="navbar-color" value="#4CAF50">
  </div>
</header>

<div id="sidebar" class="sidebar">
  <div class="sidebar-header">
    <i class='bx bx-home-alt' style="font-size: 40px; color: white;"></i>
    <h2>GestaoVet</h2>
  </div>
  <a href="#" class="closebtn" id="close-sidebar"><i class='bx bxs-chevron-right'></i></a>
  <a href="<?php echo ($_SESSION['tipo'] == 'tutor') ? 'tutor.php' : 'tutor.php'; ?>">
    <i class="bx bx-home"></i><span class="sidebar-text">Início</span>
</a>
  <a href="notificacoes.php"><i class='bx bx-bell'></i><span class="sidebar-text">Notificações</span></a>
  <a href="#"><i class='bx bxs-user'></i><span class="sidebar-text">Analíticas</span></a>
  <a href="agenda.php"><i class='bx bx-calendar'></i><span class="sidebar-text">Agenda</span></a>
  <a href="pets.php"><i class='bx bxs-cat'></i><span class="sidebar-text">Pets</span></a>


  <a href="logout.php" style="margin-top: 100px;"><i class='bx bx-log-out'></i><span class="sidebar-text">Sair</span></a>
  <a href="#"><i class='bx bx-moon theme-toggle' id="theme-toggle"></i><span class="sidebar-text">Tema</span></a>
</div>
<body>
  
    <div class="container">
        <!-- Card para adicionar novo pet -->
        <div class="add-card" onclick="openModal()">
            <i class='bx bx-plus'></i>
        </div>
        <!-- Cards de pets já cadastrados -->
        <?php foreach ($pets as $pet): ?>
        <div class="card">
        <i class='bx bxs-cat'></i> <!-- Pode ser substituído por um ícone apropriado -->
            <h3><?php echo $pet['nome']; ?></h3>
            <p><?php echo $pet['especie'] . ", " . $pet['raca'] . ", " . $pet['idade'] . " anos"; ?></p>
            <button class="btn-details" onclick="showFicha('<?php echo $pet['nome']; ?>')">Ver Detalhes</button>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Ficha do pet -->
    <div class="ficha-container" id="ficha">
        <div class="ficha-header">
            <h2>Ficha do Pet: <span id="ficha-nome"></span></h2>
            <button onclick="closeFicha()">✖</button>
        </div>
        <div class="ficha-content">
            <p><strong>Espécie:</strong> <span id="ficha-especie"></span></p>
            <p><strong>Raça:</strong> <span id="ficha-raca"></span></p>
            <p><strong>Idade:</strong> <span id="ficha-idade"></span></p>
            <p><strong>Observações:</strong></p>
            <ul id="ficha-observacoes">
                <!-- Aqui você pode adicionar observações específicas -->
            </ul>
        </div>
    </div>

    <!-- Modal para adicionar novo pet -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Adicionar Novo Pet</h2>
            <form id="addPetForm" action="ad_pet.php" method="POST">
                <input type="text" name="nome" placeholder="Nome do Pet" required>
                <input type="text" name="especie" placeholder="Espécie" required>
                <input type="text" name="raca" placeholder="Raça" required>
                <input type="number" name="idade" placeholder="Idade" required>
                <button type="submit">Adicionar</button>
            </form>
        </div>
    </div>

    <script>
        function showFicha(nome) {
            // Exemplo de dados para a ficha
            document.getElementById('ficha-nome').innerText = nome;
            document.getElementById('ficha-especie').innerText = "Cachorro"; // Substituir por dados reais
            document.getElementById('ficha-raca').innerText = "Labrador"; // Substituir por dados reais
            document.getElementById('ficha-idade').innerText = "3"; // Substituir por dados reais
            document.getElementById('ficha-observacoes').innerHTML = "<li>Vacina em dia</li>"; // Adicionar observações reais

            document.getElementById('ficha').style.display = 'flex'; // Mostrar ficha
        }

        function closeFicha() {
            document.getElementById('ficha').style.display = 'none'; // Ocultar ficha
        }

        function openModal() {
            document.getElementById('myModal').style.display = 'block'; // Mostrar modal
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none'; // Ocultar modal
        }

        document.getElementById('addPetForm').addEventListener('submit', function(event) {
            event.preventDefault();
            // Aqui você pode adicionar a lógica para salvar os dados do novo pet no banco
            closeModal(); // Fechar modal após adicionar
        });
    </script>
</body>
</html>

<footer class="footer">
  <div class="footer-content">
    <h2 class="footer-title">Gestão Veterinária</h2>
    <p class="footer-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at sapien eu justo ultrices feugiat at id quam. Vivamus eu tellus vel ex pretium hendrerit.</p>
    
    
    
  </div>
</footer>

<script>
  const themeToggle = document.getElementById('theme-toggle');
  const customizeButton = document.getElementById('customize-button');
  const colorPicker = document.getElementById('color-picker');
  const navbar = document.getElementById('navbar');
  const body = document.body;
  const sidebar = document.getElementById('sidebar');
  const menuButton = document.getElementById('menu-button');
  const closeSidebar = document.getElementById('close-sidebar');
  let customNavbarColor = '#4CAF50'; // Cor padrão da barra de navegação e da barra lateral

  themeToggle.addEventListener('click', () => {
    body.classList.toggle('dark-theme');
    themeToggle.classList.toggle('bx-sun');
    navbar.style.backgroundColor = body.classList.contains('dark-theme') ? '#121212' : customNavbarColor;
    sidebar.style.backgroundColor = body.classList.contains('dark-theme') ? '#121212' : customNavbarColor;
  });

  customizeButton.addEventListener('click', () => {
    colorPicker.style.display = colorPicker.style.display === 'block' ? 'none' : 'block';
  });

  document.getElementById('navbar-color').addEventListener('input', (event) => {
    customNavbarColor = event.target.value; // Armazenar a cor personalizada
    navbar.style.backgroundColor = customNavbarColor; // Atualizar a cor da barra de navegação
    sidebar.style.backgroundColor = customNavbarColor; // Atualizar a cor da barra lateral
  });

  menuButton.addEventListener('click', () => {
    sidebar.style.left = '0';
    navbar.style.transform = 'translateY(-100%)';
  });

  closeSidebar.addEventListener('click', () => {
    sidebar.style.left = '-250px';
    navbar.style.transform = 'translateY(0)';
  });
</script>

</html>
