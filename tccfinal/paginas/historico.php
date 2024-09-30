<?php

session_start(); // Inicia a sessão

// Conexão com o banco de dados
$host = 'localhost';
$db = 'tccdois';
$user = 'root';
$pass = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

// Captura do ID do veterinário
$veterinario_id = isset($_GET['veterinario_id']) ? $_GET['veterinario_id'] : null;

if ($veterinario_id) {
    // Criar consulta SQL com filtro para o veterinário
    $sql = "SELECT * FROM historico WHERE veterinario_id = ?";
    $params = [$veterinario_id];
} else {
    // Fallback caso não haja veterinário especificado
    $sql = "SELECT * FROM historico";
    $params = [];
}

// Adicionando outros filtros
$filterType = isset($_GET['filter-type']) ? $_GET['filter-type'] : '';
$filterTable = isset($_GET['filter-table']) ? $_GET['filter-table'] : '';
$filterDate = isset($_GET['filter-date']) ? $_GET['filter-date'] : '';

if ($filterType) {
    $sql .= " AND tipo = ?";
    $params[] = $filterType;
}
if ($filterTable) {
    $sql .= " AND tabela = ?";
    $params[] = $filterTable;
}
if ($filterDate) {
    $sql .= " AND data = ?";
    $params[] = $filterDate;
}

$sql .= " ORDER BY data DESC, hora DESC";

try {
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $historico = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($historico as $item) {
        echo "<tr>
                <td class='py-2 px-4 border-b text-center'>{$item['data']}</td>
                <td class='py-2 px-4 border-b text-center'>{$item['hora']}</td>
                <td class='py-2 px-4 border-b text-center'>{$item['tipo']}</td>
                <td class='py-2 px-4 border-b text-center'>{$item['tabela']}</td>
                <td class='py-2 px-4 border-b text-center'>{$item['id']}</td>
                <td class='py-2 px-4 border-b'>{$item['descricao']}</td>
                <td class='py-2 px-4 border-b text-center'>
                    <button class='text-blue-500 hover:underline' onclick='viewDetails({$item['id']})'>Ver Detalhes</button>
                </td>
              </tr>";
    }
} catch (PDOException $e) {
    echo "<tr><td colspan='7' class='py-2 px-4 border-b text-center text-red-500'>Erro ao buscar histórico: " . $e->getMessage() . "</td></tr>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="inicio.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="agenda.css">
  <link rel="stylesheet" href="editar.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body class="bg-gray-100">
  <header id="navbar" class="flex justify-between items-center text-white p-4">
    <nav class="">
      <div class="titulonavbar">
        <i class="bx bxs-animal-paw"></i>
        <span class="text">Histórico</span>
      </div>
      <ul class="navbarconteudo">
        <!-- Manter apenas os itens desejados -->
      </ul>
    </nav>
    <div class="flex items-center space-x-4">
      <span class="hidden md:inline-block">Bem-vindo, Usuário</span>
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
      <h2>VetEtec</h2>
    </div>
    <a href="javascript:void(0)" class="closebtn" id="close-sidebar"> <i class='bx bxs-chevron-right'></i></a>
    <a href="#"><i class='bx bx-search'></i> <input type="text" placeholder="pesquisar..." id="search-bar"></a>
    <a href="inicio.php"><i class="bx bx-home"></i><span class="sidebar-text">Início</span></a>
    <a href="notificacoes.php"><i class='bx bx-bell'></i> <span class="sidebar-text">Notificações</span></a>
    <a href="#"><i class='bx bxs-user'></i> <span class="sidebar-text">Analíticas</span></a>
    <a href="#"><i class='bx bx-calendar'></i> <span class="sidebar-text">Agenda</span></a>
    <a href="#"><i class='bx bxs-cat'></i> <span class="sidebar-text">Pets</span></a>
    <a href="#"><i class='bx bx-dollar-circle'></i> <span class="sidebar-text">Gastos</span></a>
    <a href="#" style="margin-top: 100px;"><i class='bx bx-log-out'></i> <span class="sidebar-text">Sair</span></a>
    <a href="#"><i class='bx bx-moon theme-toggle' id="theme-toggle"></i> <span class="sidebar-text tema">Tema</span></a>
  </div>

  <div class="flex">
    <div class="flex-1">
      <main class="p-6">
        <div class="bg-white p-6 rounded shadow-md">
          <div class="flex items-center space-x-4 mb-6">
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center"><i class="fas fa-arrow-left mr-2"></i> VOLTAR</button>
            <h1 class="text-xl font-bold">Histórico de Alterações</h1>
          </div>

          <div class="filter-container">
            <form method="GET" action="">
              <label for="filter-type">Tipo:</label>
              <select id="filter-type" name="filter-type">
                <option value="">Todos</option>
                <option value="Adição" <?php if (isset($_GET['filter-type']) && $_GET['filter-type'] == 'Adição') echo 'selected'; ?>>Adição</option>
                <option value="Alteração" <?php if (isset($_GET['filter-type']) && $_GET['filter-type'] == 'Alteração') echo 'selected'; ?>>Alteração</option>
                <option value="Deleção" <?php if (isset($_GET['filter-type']) && $_GET['filter-type'] == 'Deleção') echo 'selected'; ?>>Deleção</option>
              </select>

              <label for="filter-table">Tabela:</label>
              <select id="filter-table" name="filter-table">
                <option value="">Todas</option>
                <option value="Clientes" <?php if (isset($_GET['filter-table']) && $_GET['filter-table'] == 'Clientes') echo 'selected'; ?>>Clientes</option>
                <option value="Consultas" <?php if (isset($_GET['filter-table']) && $_GET['filter-table'] == 'Consultas') echo 'selected'; ?>>Consultas</option>
                <option value="Pets" <?php if (isset($_GET['filter-table']) && $_GET['filter-table'] == 'Pets') echo 'selected'; ?>>Pets</option>
              </select>

              <label for="filter-date">Data:</label>
              <input type="date" id="filter-date" name="filter-date" value="<?php if (isset($_GET['filter-date'])) echo $_GET['filter-date']; ?>">

              <button class="bg-blue-500 text-white px-4 py-2 rounded" type="submit">Aplicar Filtros</button>
            </form>
          </div>

          <div class="search-container">
            <input type="text" id="search-bar" placeholder="Pesquisar histórico..." class="border rounded px-4 py-2 w-full">
          </div>

          <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
              <thead>
                <tr>
                  <th class="py-2 px-4 border-b">Data</th>
                  <th class="py-2 px-4 border-b">Hora</th>
                  <th class="py-2 px-4 border-b">Tipo</th>
                  <th class="py-2 px-4 border-b">Tabela</th>
                  <th class="py-2 px-4 border-b">ID</th>
                  <th class="py-2 px-4 border-b">Descrição</th>
                  <th class="py-2 px-4 border-b">Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                 // Inclua a configuração da conexão com o banco de dados

                // Verifique se a conexão foi criada
                if (!isset($conn)) {
                    die('Erro na conexão com o banco de dados.');
                }

                // Definir variáveis de filtro
                $filterType = isset($_GET['filter-type']) ? $_GET['filter-type'] : '';
                $filterTable = isset($_GET['filter-table']) ? $_GET['filter-table'] : '';
                $filterDate = isset($_GET['filter-date']) ? $_GET['filter-date'] : '';

                // Criar consulta SQL com filtros
                $sql = "SELECT * FROM historico WHERE 1=1";
                $params = [];

                if ($filterType) {
                    $sql .= " AND tipo = ?";
                    $params[] = $filterType;
                }
                if ($filterTable) {
                    $sql .= " AND tabela = ?";
                    $params[] = $filterTable;
                }
                if ($filterDate) {
                    $sql .= " AND data = ?";
                    $params[] = $filterDate;
                }

                $sql .= " ORDER BY data DESC, hora DESC";

                // Executar a consulta
                try {
                    $stmt = $conn->prepare($sql);
                    $stmt->execute($params);
                    $historico = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Exibir resultados
                    foreach ($historico as $item) {
                        echo "<tr>
                                <td class='py-2 px-4 border-b text-center'>{$item['data']}</td>
                                <td class='py-2 px-4 border-b text-center'>{$item['hora']}</td>
                                <td class='py-2 px-4 border-b text-center'>{$item['tipo']}</td>
                                <td class='py-2 px-4 border-b text-center'>{$item['tabela']}</td>
                                <td class='py-2 px-4 border-b text-center'>{$item['id']}</td>
                                <td class='py-2 px-4 border-b'>{$item['descricao']}</td>
                                <td class='py-2 px-4 border-b text-center'>
                                    <button class='text-blue-500 hover:underline' onclick='viewDetails({$item['id']})'>Ver Detalhes</button>
                                </td>
                              </tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='7' class='py-2 px-4 border-b text-center text-red-500'>Erro ao buscar histórico: " . $e->getMessage() . "</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
  </div>

  <script>
    // Script para abrir e fechar o menu lateral
    const menuButton = document.getElementById('menu-button');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('close-sidebar');

    menuButton.addEventListener('click', () => {
      sidebar.style.width = '250px';
    });

    closeSidebar.addEventListener('click', () => {
      sidebar.style.width = '0';
    });

    // Script para alterar a cor da navbar
    const colorPicker = document.getElementById('navbar-color');
    colorPicker.addEventListener('input', (event) => {
      document.getElementById('navbar').style.backgroundColor = event.target.value;
    });

    // Script para alternar tema
    const themeToggle = document.getElementById('theme-toggle');
    themeToggle.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
      themeToggle.classList.toggle('bx-sun');
      themeToggle.classList.toggle('bx-moon');
    });

    // Script para pesquisa
    const searchBar = document.getElementById('search-bar');
    searchBar.addEventListener('input', () => {
      const searchTerm = searchBar.value.toLowerCase();
      const rows = document.querySelectorAll('tbody tr');
      rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        const matches = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(searchTerm));
        row.style.display = matches ? '' : 'none';
      });
    });

    // Função para exibir detalhes (exemplo de implementação)
    function viewDetails(id) {
      alert('Detalhes para o ID: ' + id);
    }
  </script>
</body>

</html>
