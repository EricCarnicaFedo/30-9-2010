<?php
include('conexaobd.php');

// Check if session is already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verify if the user is logged in and is a veterinarian
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] != 'veterinario') {
    header("Location: login.php");
    exit();
}

// Obtain the clinic ID of the logged-in veterinarian
$clinica_id = $_SESSION['clinica_id'];

// Continue with the rest of your code...
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- CSS -->
  <link rel="stylesheet" href="inicio.css">
  <link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="agenda.css">
<link rel="stylesheet" href="editar.css">
  <link rel="stylesheet" href="pets.css">
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="sections.css">

  <!-- Fontes -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
  <!-- Boxicons CSS -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Título da Página -->
  <!--<title>Dashboard Sidebar Menu</title>-->
</head>

<body>
<header id="navbar" class="flex justify-between items-center text-white p-4">
    <nav>
        <div class="titulonavbar">
            <i class="bx bxs-animal-paw"></i>
            <span class="text">Pets</span>
        </div>
        <ul class="navbarconteudo">
            <!-- Manter apenas os itens desejados -->
        </ul>
    </nav>

    <div class="flex items-center space-x-4">
        <!-- Verifica se o nome do usuário está na sessão -->
        <span class="hidden md:inline-block">Bem-vindo, <?php echo isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : 'Usuário'; ?></span>

        <a href="logout.php" class="hover:underline">Sair</a>
        <i class="bx bx-bell"></i>
        <img src="https://placehold.co/30x30" alt="User avatar" class="w-8 h-8 rounded-full">
    </div>

    <i class='bx bx-menu menu-button' id="menu-button" style="font-size: 30px;"></i>
    <i class='bx bx-cog customize-button' id="customize-button" style="font-size: 20px;"></i>
    <div id="color-picker">
        <label for="navbar-color">Choose navbar color:</label>
        <input type="color" id="navbar-color" name="navbar-color" value="#4CAF50">
    </div>
</header>

  <div id="sidebar" class="sidebar">
    <div class="sidebar-header">
      <i class='bx bx-home-alt' style="font-size: 40px; color: white;"></i>
      <h2>VetEtec</h2>
    </div>
    <a href="javascript:void(0)" class="closebtn" id="close-sidebar"><i class='bx bxs-chevron-right'></i></a>
    <a href="#"><i class='bx bx-search'></i> <input type="text" placeholder="pesquisar..." id="search-bar"></a>
    <a href="inicio.php"><i class="bx bx-home"></i><span class="sidebar-text">Início</span></a>
    <a href="notificacoes.php"><i class='bx bx-bell'></i> <span class="sidebar-text">Notificações</span></a>
  <a href="#"><i class='bx bxs-user'></i> <span class="sidebar-text">Analíticas</span></a>
  <a href="agenda.php"><i class='bx bx-calendar'></i> <span class="sidebar-text">Agenda</span></a>
  <a href="pets.php"><i class='bx bxs-cat'></i> <span class="sidebar-text">Pets</span></a>
  <a href="historico.php"><i class='bx bxs-time'></i> <span class="sidebar-text">Historico</span></a>
  <a href="cadastroteste.php"><i class='bx bxs-file-plus'></i> <span class="sidebar-text">Cadastros</span></a>
  <a href="logout.php" style="margin-top: 100px;">
  <i class='bx bx-log-out'></i> <span class="sidebar-text">Sair</span>
</a>

    <a href="#"><i class='bx bx-moon theme-toggle' id="theme-toggle"></i> <span class="sidebar-text tema">Tema</span></a>
  </div>

  <?php
require('conexaobd.php'); // Inclua seu arquivo de conexão com o banco de dados
require('classedashboard.php'); // Inclua o arquivo da classe Dashboard

// Instanciar a classe Dashboard
$dashboard = new Dashboard($pdo);

// Obter os dados
$totalPacientes = $dashboard->getTotalPacientes();
$totalTratamentosAndamento = $dashboard->getTratamentosAndamento();
$totalConsultasHoje = $dashboard->getConsultasHoje();
?>

<main class="dashboard-container">
        <section class="dashboard">
            <div class="dashboard-card">
                <i class="fas fa-user-md"></i>
                <h3>Total de Pacientes</h3>
                <p><?php echo $totalPacientes; ?></p>
            </div>
            <div class="dashboard-card">
                <i class="fas fa-stethoscope"></i>
                <h3>Tratamentos em Andamento</h3>
                <p><?php echo $totalTratamentosAndamento; ?></p>
            </div>
            <div class="dashboard-card">
                <i class="fas fa-calendar-day"></i>
                <h3>Consultas Hoje</h3>
                <p><?php echo $totalConsultasHoje; ?></p>
            </div>
        </section>
    </main>
<!-- seção de tabelas -->
<body class="bg-gray-100">
    <div class="flex">
        <!-- Main content -->
        <div class="flex-1">
        <main class="p-6">
    <div class="bg-white p-6 rounded shadow-md">
        <div class="flex items-center space-x-4 mb-6">
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center"><i class="fas fa-arrow-left mr-2"></i> VOLTAR</button>
            <h1 class="text-xl font-bold">Pacientes</h1>
        </div>
        <div class="flex justify-between items-center mb-4 flex-wrap">
            <div class="flex space-x-4">
                 <button class="bg-blue-500 text-white px-4 py-2 rounded flex items-center" onclick="window.location.href='cadastroteste.php';">
        <i class="bx bxs-plus-circle mr-2"></i> Novo
    </button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-print mr-2"></i> Imprimir</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-file-export mr-2"></i> Exportar Planilha</button>
            </div>
            <div class="flex items-center space-x-2 flex-wrap mt-4 md:mt-0">
                <label for="estado" class="mr-2">Estado</label>
                <select id="estado" class="border-gray-300 border p-2 rounded">
                    <option>Ativo</option>
                </select>
                <label for="desde" class="ml-4 mr-2">Desde</label>
                <select id="desde" class="border-gray-300 border p-2 rounded">
                    <option>Janeiro</option>
                </select>
                <label for="ate" class="ml-4 mr-2">Até</label>
                <select id="ate" class="border-gray-300 border p-2 rounded">
                    <option>Dezembro</option>
                </select>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded ml-4 flex items-center"><i class="fas fa-filter mr-2"></i> Filtrar</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nome do Animal</th>
                        <th class="py-2 px-4 border-b">Raça</th>
                        <th class="py-2 px-4 border-b">Proprietário</th>
                        <th class="py-2 px-4 border-b">Idade</th>
                        <th class="py-2 px-4 border-b">Sexo</th>
                        <th class="py-2 px-4 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    require("classepaciente.php");

    $paciente = new Paciente();
    $pacientes = $paciente->listar();

    foreach ($pacientes as $registro) {
    ?>
    <tr>
        <td style="padding: 10px; text-align: center;"><?php echo isset($registro["idPaciente"]) ? $registro["idPaciente"] : "N/A"; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo isset($registro["nome"]) ? $registro["nome"] : "N/A"; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo isset($registro["raca"]) ? $registro["raca"] : "N/A"; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo isset($registro["proprietario"]) ? $registro["proprietario"] : "N/A"; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo isset($registro["idade"]) ? $registro["idade"] : "N/A"; ?></td>
        <td style="padding: 10px; text-align: center;">
            <?php echo isset($registro["sexo"]) ? ($registro["sexo"] == 'Macho' ? 'Macho' : 'Fêmea') : "N/A"; ?>
        </td>
        <td style="padding: 10px; text-align: center;">
            <button style="margin-left: 10px; padding: 5px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="showPopup(<?php echo $registro['idPaciente']; ?>)">
                <i class="fas fa-pencil-alt"></i>
            </button>
            <button style="margin-left: 5px; padding: 5px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="if(confirm('Tem certeza que deseja deletar este paciente?')) location.href='deletar_paciente.php?id=<?php echo $registro['idPaciente']; ?>'">
                <i class="fas fa-trash-alt"></i>
            </button>
        </td>
    </tr>
    <?php
    }
    ?>
</tbody>


            </table>
        </div>
        <div class="botaozin">
            <div class="flex justify-between items-center mt-4">
                <span class="text-gray-600">Mostrando de 1 até 7 de 7 registros</span>
                <div>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-l">Anterior</button>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-r">Próximo</button>
                </div>
            </div>
        </div>
    </div>
</main>
    <main class="p-6">
    <div class="bg-white p-6 rounded shadow-md">
        <div class="flex items-center space-x-4 mb-6">
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center"><i class="fas fa-arrow-left mr-2"></i> VOLTAR</button>
            <h1 class="text-xl font-bold">Histórico de Vacinas</h1>
        </div>
        <div class="flex justify-between items-center mb-4 flex-wrap">
            <div class="flex space-x-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                    <i class="bx bxs-plus-circle mr-2"></i> Nova Vacina
                </button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-print mr-2"></i> Imprimir</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-file-export mr-2"></i> Exportar Planilha</button>
            </div>
            <div class="flex items-center space-x-2 flex-wrap mt-4 md:mt-0">
                <label for="estado" class="mr-2">Estado</label>
                <select id="estado" class="border-gray-300 border p-2 rounded">
                    <option>Ativo</option>
                </select>
                <label for="desde" class="ml-4 mr-2">Desde</label>
                <select id="desde" class="border-gray-300 border p-2 rounded">
                    <option>Janeiro</option>
                </select>
                <label for="ate" class="ml-4 mr-2">Até</label>
                <select id="ate" class="border-gray-300 border p-2 rounded">
                    <option>Dezembro</option>
                </select>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded ml-4 flex items-center"><i class="fas fa-filter mr-2"></i> Filtrar</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nome do Animal</th>
                        <th class="py-2 px-4 border-b">Vacina</th>
                        <th class="py-2 px-4 border-b">Data da Aplicação</th>
                        <th class="py-2 px-4 border-b">Veterinário</th>
                        <th class="py-2 px-4 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
require("classehistoricoVacina.php");

$historicoVacina = new HistoricoVacina();
$vacinas = $historicoVacina->listar();

foreach ($vacinas as $registro) {
?>
    <tr>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["idHistorico"]; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["nomeAnimal"]; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["nomeVacina"]; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["dataAplicacao"]; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["veterinario"]; ?></td>
        <td style="padding: 10px; text-align: center;">
            <button style="margin-left: 10px; padding: 5px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="showPopup(<?php echo $registro['idHistorico']; ?>)">
                <i class="fas fa-pencil-alt"></i> <!-- Ícone de lápis -->
            </button> 
            <button style="margin-left: 5px; padding: 5px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="if(confirm('Tem certeza que deseja deletar esta vacina?')) location.href='deletar_vacina.php?id=<?php echo $registro['idHistorico']; ?>'">
                <i class="fas fa-trash-alt"></i> <!-- Ícone de lixeira -->
            </button>
        </td>
    </tr>
<?php
}
?>
                </tbody>
            </table>
        </div>
        <div class="botaozin">
            <div class="flex justify-between items-center mt-4">
                <span class="text-gray-600">Mostrando de 1 até 7 de 7 registros</span>
                <div>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-l">Anterior</button>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-r">Próximo</button>
                </div>
            </div>
        </div>
    </div>
</main>

<main class="p-6">
    <div class="bg-white p-6 rounded shadow-md">
        <div class="flex items-center space-x-4 mb-6">
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center"><i class="fas fa-arrow-left mr-2"></i> VOLTAR</button>
            <h1 class="text-xl font-bold">Exames Realizados</h1>
        </div>
        <div class="flex justify-between items-center mb-4 flex-wrap">
            <div class="flex space-x-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded flex items-center" onclick="window.location.href='cadastroteste.php';">
        <i class="bx bxs-plus-circle mr-2"></i> Novo
    </button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-print mr-2"></i> Imprimir</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-file-export mr-2"></i> Exportar Planilha</button>
            </div>
            <div class="flex items-center space-x-2 flex-wrap mt-4 md:mt-0">
                <label for="estado" class="mr-2">Estado</label>
                <select id="estado" class="border-gray-300 border p-2 rounded">
                    <option>Ativo</option>
                </select>
                <label for="desde" class="ml-4 mr-2">Desde</label>
                <select id="desde" class="border-gray-300 border p-2 rounded">
                    <option>Janeiro</option>
                </select>
                <label for="ate" class="ml-4 mr-2">Até</label>
                <select id="ate" class="border-gray-300 border p-2 rounded">
                    <option>Dezembro</option>
                </select>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded ml-4 flex items-center"><i class="fas fa-filter mr-2"></i> Filtrar</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nome do Animal</th>
                        <th class="py-2 px-4 border-b">Tipo de Exame</th>
                        <th class="py-2 px-4 border-b">Data do Exame</th>
                        <th class="py-2 px-4 border-b">Resultado</th>
                        <th class="py-2 px-4 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
require("classeexames.php");

$exame = new Exames();
$exames = $exame->listar();

foreach ($exames as $registro) {
?>
<tr>
<td style="padding: 10px; text-align: center;"><?php echo htmlspecialchars($registro["idExame"]); ?></td>
    <td style="padding: 10px; text-align: center;"><?php echo htmlspecialchars($registro["nomeAnimal"]); ?></td>
    <td style="padding: 10px; text-align: center;"><?php echo htmlspecialchars($registro["tipoExame"]); ?></td>
    <td style="padding: 10px; text-align: center;"><?php echo htmlspecialchars($registro["dataExame"]); ?></td>
    <td style="padding: 10px; text-align: center;"><?php echo htmlspecialchars($registro["resultado"]); ?></td>
    <td style="padding: 10px; text-align: center;">
        <button style="margin-left: 10px; padding: 5px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="showPopup(<?php echo $registro['idExame']; ?>)">
            <i class="fas fa-pencil-alt"></i> <!-- Ícone de lápis -->
        </button> 
        <button style="margin-left: 5px; padding: 5px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="if(confirm('Tem certeza que deseja deletar este exame?')) location.href='deletar_exame.php?id=<?php echo $registro['idExame']; ?>'">
            <i class="fas fa-trash-alt"></i> <!-- Ícone de lixeira -->
        </button>
    </td>
</tr>
<?php
}
?>
                </tbody>
            </table>
        </div>
        <div class="botaozin">
            <div class="flex justify-between items-center mt-4">
                <span class="text-gray-600">Mostrando de 1 até <?php echo count($exames); ?> de <?php echo count($exames); ?> registros</span>
                <div>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-l">Anterior</button>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-r">Próximo</button>
                </div>
            </div>
        </div>
    </div>
</main>

<main class="p-6">
    <div class="bg-white p-6 rounded shadow-md">
        <div class="flex items-center space-x-4 mb-6">
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center"><i class="fas fa-arrow-left mr-2"></i> VOLTAR</button>
            <h1 class="text-xl font-bold">Medicamentos Prescritos</h1>
        </div>
        <div class="flex justify-between items-center mb-4 flex-wrap">
            <div class="flex space-x-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded flex items-center" onclick="window.location.href='cadastroteste.php';">
        <i class="bx bxs-plus-circle mr-2"></i> Novo Medicamento
    </button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-print mr-2"></i> Imprimir</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-file-export mr-2"></i> Exportar Planilha</button>
            </div>
            <div class="flex items-center space-x-2 flex-wrap mt-4 md:mt-0">
                <label for="estado" class="mr-2">Estado</label>
                <select id="estado" class="border-gray-300 border p-2 rounded">
                    <option>Ativo</option>
                </select>
                <label for="desde" class="ml-4 mr-2">Desde</label>
                <select id="desde" class="border-gray-300 border p-2 rounded">
                    <option>Janeiro</option>
                </select>
                <label for="ate" class="ml-4 mr-2">Até</label>
                <select id="ate" class="border-gray-300 border p-2 rounded">
                    <option>Dezembro</option>
                </select>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded ml-4 flex items-center"><i class="fas fa-filter mr-2"></i> Filtrar</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nome do Animal</th>
                        <th class="py-2 px-4 border-b">Medicamento</th>
                        <th class="py-2 px-4 border-b">Data da Prescrição</th>
                        <th class="py-2 px-4 border-b">Dosagem</th>
                        <th class="py-2 px-4 border-b">ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
require("classemedicamentos.php");

$medicamento = new Medicamento();
$medicamentos = $medicamento->listar();

foreach ($medicamentos as $registro) {
?>
<tr>
<td style="padding: 10px; text-align: center;"><?php echo $registro["idPrescricao"]; ?></td>
    <td style="padding: 10px; text-align: center;"><?php echo $registro["nomeAnimal"]; ?></td>
    <td style="padding: 10px; text-align: center;"><?php echo $registro["medicamento"]; ?></td>
    <td style="padding: 10px; text-align: center;"><?php echo $registro["dataPrescricao"]; ?></td>
    <td style="padding: 10px; text-align: center;"><?php echo $registro["dosagem"]; ?></td>
    <td style="padding: 10px; text-align: center;">
        <button style="margin-left: 10px; padding: 5px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="showPopup(<?php echo $registro['idExame']; ?>)">
            <i class="fas fa-pencil-alt"></i> <!-- Ícone de lápis -->
        </button> 
        <button style="margin-left: 5px; padding: 5px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="if(confirm('Tem certeza que deseja deletar este exame?')) location.href='deletar_exame.php?id=<?php echo $registro['idExame']; ?>'">
            <i class="fas fa-trash-alt"></i> <!-- Ícone de lixeira -->
        </button>
    </td>
</tr>
<?php
}
?>
                </tbody>
            </table>
        </div>
        <div class="botaozin">
            <div class="flex justify-between items-center mt-4">
                <span class="text-gray-600">Mostrando de 1 até 7 de 7 registros</span>
                <div>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-l">Anterior</button>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-r">Próximo</button>
                </div>
            </div>
        </div>
    </div>
</main>
<main class="p-6">
    <div class="bg-white p-6 rounded shadow-md">
        <div class="flex items-center space-x-4 mb-6">
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center"><i class="fas fa-arrow-left mr-2"></i> VOLTAR</button>
            <h1 class="text-xl font-bold">Tutores</h1>
        </div>
        <div class="flex justify-between items-center mb-4 flex-wrap">
            <div class="flex space-x-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded flex items-center" onclick="window.location.href='cadastroteste.php';">
        <i class="bx bxs-plus-circle mr-2"></i> Novo tutor
    </button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-print mr-2"></i> Imprimir</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-file-export mr-2"></i> Exportar Planilha</button>
            </div>
            <div class="flex items-center space-x-2 flex-wrap mt-4 md:mt-0">
                <label for="estado" class="mr-2">Estado</label>
                <select id="estado" class="border-gray-300 border p-2 rounded">
                    <option>Ativo</option>
                </select>
                <label for="desde" class="ml-4 mr-2">Desde</label>
                <select id="desde" class="border-gray-300 border p-2 rounded">
                    <option>Janeiro</option>
                </select>
                <label for="ate" class="ml-4 mr-2">Até</label>
                <select id="ate" class="border-gray-300 border p-2 rounded">
                    <option>Dezembro</option>
                </select>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded ml-4 flex items-center"><i class="fas fa-filter mr-2"></i> Filtrar</button>
            </div>
        </div>
        <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b">ID</th>
            <th class="py-2 px-4 border-b">Nome do Tutor</th>
            <th class="py-2 px-4 border-b">Email</th>
            <th class="py-2 px-4 border-b">Telefone</th>
            <th class="py-2 px-4 border-b">Endereço</th>
            <th class="py-2 px-4 border-b">Cidade</th>
            <th class="py-2 px-4 border-b">Estado</th>
            <th class="py-2 px-4 border-b">CEP</th>
            <th class="py-2 px-4 border-b">Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php
    require("classetutores.php");

    $tutor = new Tutor();
    $tutores = $tutor->listar();

    foreach ($tutores as $registro) {
    ?>
    <tr>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["id"]; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["nome"]; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["email"]; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["telefone"] ; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["endereco"] ; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["cidade"] ; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["estado"] ; ?></td>
        <td style="padding: 10px; text-align: center;"><?php echo $registro["cep"] ; ?></td>
        <td style="padding: 10px; text-align: center;">
            <button style="margin-left: 10px; padding: 5px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="showPopup(<?php echo $registro['id']; ?>)">
                <i class="fas fa-pencil-alt"></i> <!-- Ícone de lápis -->
            </button> 
            <button style="margin-left: 5px; padding: 5px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="if(confirm('Tem certeza que deseja deletar este tutor?')) location.href='deletar_tutor.php?id=<?php echo $registro['id']; ?>'">
                <i class="fas fa-trash-alt"></i> <!-- Ícone de lixeira -->
            </button>
        </td>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>

        </div>
        <div class="botaozin">
            <div class="flex justify-between items-center mt-4">
                <span class="text-gray-600">Mostrando de 1 até 7 de 7 registros</span>
                <div>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-l">Anterior</button>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-r">Próximo</button>
                </div>
            </div>
        </div>
    </div>
</main>
<main class="p-6">
    <div class="bg-white p-6 rounded shadow-md">
        <div class="flex items-center space-x-4 mb-6">
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center"><i class="fas fa-arrow-left mr-2"></i> VOLTAR</button>
            <h1 class="text-xl font-bold">Tratamentos</h1>
        </div>
        <div class="flex justify-between items-center mb-4 flex-wrap">
            <div class="flex space-x-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded flex items-center" onclick="window.location.href='cadastroteste.php';">
        <i class="bx bxs-plus-circle mr-2"></i> Novo Tratamento
    </button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-print mr-2"></i> Imprimir</button>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded flex items-center"><i class="fas fa-file-export mr-2"></i> Exportar Planilha</button>
            </div>
            <div class="flex items-center space-x-2 flex-wrap mt-4 md:mt-0">
                <label for="estado" class="mr-2">Estado</label>
                <select id="estado" class="border-gray-300 border p-2 rounded">
                    <option>Em Andamento</option>
                    <option>Concluído</option>
                    <option>Pendente</option>
                </select>
                <label for="desde" class="ml-4 mr-2">Desde</label>
                <select id="desde" class="border-gray-300 border p-2 rounded">
                    <option>Janeiro</option>
                </select>
                <label for="ate" class="ml-4 mr-2">Até</label>
                <select id="ate" class="border-gray-300 border p-2 rounded">
                    <option>Dezembro</option>
                </select>
                <button class="bg-yellow-500 text-white px-4 py-2 rounded ml-4 flex items-center"><i class="fas fa-filter mr-2"></i> Filtrar</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">ID</th>
                        <th class="py-2 px-4 border-b">Nome do Animal</th>
                        <th class="py-2 px-4 border-b">Tipo de Tratamento</th>
                        <th class="py-2 px-4 border-b">Data do Tratamento</th>
                        <th class="py-2 px-4 border-b">Resultado</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require("classetratamento.php");

                $tratamento = new Tratamento();  
                $tratamentos = $tratamento->listar(); 

                foreach ($tratamentos as $registro) {
                    // Define a cor com base no status
                    switch ($registro["status"]) {
                        case 'Andamento':
                            $statusColor = 'bg-yellow-500'; // Amarelo
                            break;
                        case 'Concluído':
                            $statusColor = 'bg-green-500'; // Verde
                            break;
                        case 'Pendente':
                            $statusColor = 'bg-red-500'; // Vermelho
                            break;
                        default:
                            $statusColor = 'bg-gray-500'; // Cor padrão se o status não for reconhecido
                            break;
                    }
                ?>
                <tr>
                    <td style="padding: 10px; text-align: center;"><?php echo $registro["idTratamento"]; ?></td>
                    <td style="padding: 10px; text-align: center;"><?php echo $registro["nomeAnimal"]; ?></td>
                    <td style="padding: 10px; text-align: center;"><?php echo $registro["tipoTratamento"]; ?></td>
                    <td style="padding: 10px; text-align: center;"><?php echo $registro["dataTratamento"]; ?></td>
                    <td style="padding: 10px; text-align: center;"><?php echo $registro["resultado"]; ?></td>
                    <td style="padding: 10px; text-align: center;">
                        <span class="text-white px-2 py-1 rounded <?php echo $statusColor; ?>">
                            <?php echo $registro["status"]; ?>
                        </span>
                    </td>
                    <td style="padding: 10px; text-align: center;">
                        <!-- Botão de editar -->
                        <button style="margin-left: 10px; padding: 5px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="showPopup(<?php echo $registro['idTratamento']; ?>)">
                            <i class="fas fa-pencil-alt"></i> <!-- Ícone de lápis -->
                        </button>
                        <!-- Botão de deletar -->
                        <button style="margin-left: 5px; padding: 5px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;" onclick="if(confirm('Tem certeza que deseja deletar este tratamento?')) location.href='deletar_tratamento.php?id=<?php echo $registro['idTratamento']; ?>'">
                            <i class="fas fa-trash-alt"></i> <!-- Ícone de lixeira -->
                        </button>
                    </td>
                </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="botaozin">
            <div class="flex justify-between items-center mt-4">
                <span class="text-gray-600">Mostrando de 1 até 7 de 7 registros</span>
                <div>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-l">Anterior</button>
                    <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-r">Próximo</button>
                </div>
            </div>
        </div>
    </div>
</main>

        </div>
    </div>
    
<!-- Seção de Anotações -->
<main class="notes-container">
  <div class="notes-header">
    <h2>Anotações</h2>
  </div>
  <div class="notes-content">
    <textarea id="note-input" placeholder="Digite sua nota aqui..."></textarea>
    <button id="save-note">
      <i class='bx bx-save'></i> Salvar Nota
    </button>
  </div>
  <div class="notes-list">
    <h3>Notas Salvas</h3>
    <ul id="note-list">
      <!-- Notas serão adicionadas aqui -->
    </ul>
  </div>
</main>
  <footer class="footer">
    <div class="footer-content">
      <h2 class="footer-title">Gestão Veterinária</h2>
      <p class="footer-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at sapien eu justo ultrices feugiat at id quam. Vivamus eu tellus vel ex pretium hendrerit. Phasellus eget vehicula ex, sit amet dictum felis.</p>
      <ul class="footer-links">
        <li><a href="#">Início</a></li>
        <li><a href="#">Sobre</a></li>
        <li><a href="#">Serviços</a></li>
        <li><a href="#">Equipe</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
      <div class="social-icons">
        <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/facebook-new.png" alt="Facebook"></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/twitter.png" alt="Twitter"></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/linkedin.png" alt="LinkedIn"></a>
        <a href="#"><img src="https://img.icons8.com/ios-filled/50/ffffff/instagram-new.png" alt="Instagram"></a>
      </div>
      <div class="contact-info">
        <div class="contact-info-item">
          <img src="https://img.icons8.com/material-rounded/24/ffffff/phone--v1.png" alt="Telefone">
          +1 234 567 890
        </div>
        <div class="contact-info-item">
          <img src="https://img.icons8.com/material-rounded/24/ffffff/email-open--v1.png" alt="E-mail">
          exemplo@exemplo.com
        </div>
      </div>
      <div class="subscribe">
        <input type="email" class="subscribe-input" placeholder="Digite seu e-mail">
        <button class="subscribe-button">Assinar</button>
      </div>
      <div class="company-info">
        <h3>Sobre Nós</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at sapien eu justo ultrices feugiat at id quam. Vivamus eu tellus vel ex pretium hendrerit. Phasellus eget vehicula ex, sit amet dictum felis.</p>
      </div>
      <div class="quick-links">
        <h3>Links Rápidos</h3>
        <ul>
          <li><a href="#">Política de Privacidade</a></li>
          <li><a href="#">Termos de Serviço</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Suporte</a></li>
        </ul>
      </div>
      <div class="about-section">
        <h3>Nossa Missão</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at sapien eu justo ultrices feugiat at id quam. Vivamus eu tellus vel ex pretium hendrerit. Phasellus eget vehicula ex, sit amet dictum felis.</p>
      </div>
      <div class="animal-images">
        <img src="https://placeimg.com/100/100/animals" alt="Animal">
        <img src="https://placeimg.com/100/100/animals" alt="Animal">
        <img src="https://placeimg.com/100/100/animals" alt="Animal">
        <img src="https://placeimg.com/100/100/animals" alt="Animal">
      </div>
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
    let customNavbarColor = '#afd4c3'; // Cor padrão da barra de navegação e da barra lateral

    themeToggle.addEventListener('click', () => {
      body.classList.toggle('dark-theme');
      themeToggle.classList.toggle('bx-sun');
      // Restaurar a cor personalizada ao alternar entre temas claro e escuro
      if (body.classList.contains('dark-theme')) {
        navbar.style.backgroundColor = '#121212'; // Cor de fundo padrão do tema escuro
        sidebar.style.backgroundColor = '#121212'; // Cor de fundo padrão do tema escuro para a barra lateral
      } else {
        navbar.style.backgroundColor = customNavbarColor; // Restaurar a cor personalizada da barra de navegação
        sidebar.style.backgroundColor = customNavbarColor; // Restaurar a cor personalizada da barra lateral
      }
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

    document.getElementById('customize-button').addEventListener('click', function() {
      this.classList.toggle('rotated'); // Adiciona ou remove a classe 'rotated' ao clicar
    });

    document.addEventListener('DOMContentLoaded', function() {
      var conteudo = document.querySelector('.conteudo');
      setTimeout(function() {
        conteudo.classList.add('entrou');
      }, 500); // Ajuste o tempo conforme necessário
    });

    document.addEventListener('DOMContentLoaded', function() {
  const saveNoteButton = document.getElementById('save-note');
  const noteInput = document.getElementById('note-input');
  const noteList = document.getElementById('note-list');

  // Função para adicionar uma nota
  function addNote() {
    const noteText = noteInput.value.trim();
    if (noteText) {
      const li = document.createElement('li');
      li.innerHTML = `
        <span class="note-text">${noteText}</span>
        <div class="note-actions">
          <i class='bx bxs-edit' onclick="editNote(this)"></i>
          <i class='bx bxs-trash' onclick="deleteNote(this)"></i>
        </div>
      `;
      noteList.appendChild(li);
      noteInput.value = ''; // Limpar o campo de entrada
    } else {
      alert('Digite uma nota para salvar.');
    }
  }

  // Função para deletar uma nota
  function deleteNote(icon) {
    const li = icon.closest('li');
    li.remove();
  }

  // Função para editar uma nota
  function editNote(icon) {
    const li = icon.closest('li');
    const noteTextSpan = li.querySelector('.note-text');
    const newNoteText = prompt('Edite sua nota:', noteTextSpan.textContent);
    if (newNoteText !== null) {
      noteTextSpan.textContent = newNoteText;
    }
  }

  // Adicionar a nota ao clicar no botão
  saveNoteButton.addEventListener('click', addNote);

  // Adicionar a nota ao pressionar Enter
  noteInput.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
      event.preventDefault(); // Evitar o envio do formulário
      addNote();
    }
  });
});

  </script>
  <script>
document.querySelectorAll('.navbarconteudo a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>
</body>

</html>
