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
  <link rel="stylesheet" href="pets.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.tailwindcss.com"></script>
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
      <span class="hidden md:inline-block">Bem-vindo, Cliente</span>
      <a href="#" class="hover:underline">Sair</a>
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
    <a href="javascript:void(0)" class="closebtn" id="close-sidebar"><i class='bx bxs-chevron-right'></i></a>
    <a href="#"><i class='bx bx-search'></i> <input type="text" placeholder="pesquisar..." id="search-bar"></a>
    <a href="inicio.html"><i class="bx bx-home"></i><span class="sidebar-text">Início</span></a>
    <a href="notificacoes.html"><i class='bx bx-bell'></i> <span class="sidebar-text">Notificações</span></a>
    <a href="#"><i class='bx bxs-user'></i> <span class="sidebar-text">Analíticas</span></a>
    <a href="#"><i class='bx bx-calendar'></i> <span class="sidebar-text">Agenda</span></a>
    <a href="pets.html"><i class='bx bxs-cat'></i> <span class="sidebar-text">Pets</span></a>
    <a href="#"><i class='bx bx-dollar-circle'></i> <span class="sidebar-text">Gastos</span></a>
    <a href="#" style="margin-top: 100px;"><i class='bx bx-log-out'></i> <span class="sidebar-text">Sair</span></a>
    <a href="#"><i class='bx bx-moon theme-toggle' id="theme-toggle"></i> <span class="sidebar-text tema">Tema</span></a>
  </div>

  <main class="p-6">
    <div class="bg-white p-6 rounded shadow-md">
        <div class="flex items-center space-x-4 mb-6">
            <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center"><i class="fas fa-arrow-left mr-2"></i> VOLTAR</button>
            <h1 class="text-xl font-bold">Detalhes do Pet</h1>
        </div>

        <!-- Seção para Selecionar Outros Pets -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Escolher Outro Pet</h2>
            <div class="border p-4 rounded bg-gray-100">
                <label for="pet-select" class="block mb-2"><strong>Selecione o Pet:</strong></label>
                <select id="pet-select" class="border-gray-300 border p-2 rounded w-full">
                    <option value="rex">Rex - Cachorro</option>
                    <option value="miau">Miau - Gato</option>
                    <option value="pingo">Pingo - Coelho</option>
                    <!-- Adicionar mais opções conforme necessário -->
                </select>
                <button class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Ver Detalhes</button>
            </div>
        </div>

        <!-- Seção de Informações Básicas -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Informações Básicas</h2>
            <div class="border p-4 rounded bg-gray-100">
                <p><strong>Nome do Pet:</strong> Rex</p>
                <p><strong>Espécie:</strong> Cachorro</p>
                <p><strong>Raça:</strong> Labrador</p>
                <p><strong>Idade:</strong> 3 anos</p>
            </div>
        </div>

        <!-- Seção de Consultas -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Consultas Recentes</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Data</th>
                            <th class="py-2 px-4 border-b">Tipo</th>
                            <th class="py-2 px-4 border-b">Médico</th>
                            <th class="py-2 px-4 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b">01/09/2024</td>
                            <td class="py-2 px-4 border-b">Check-up</td>
                            <td class="py-2 px-4 border-b">Dr. Silva</td>
                            <td class="py-2 px-4 border-b">
                                <span class="text-white px-2 py-1 rounded bg-green-500">Realizada</span>
                            </td>
                        </tr>
                        <!-- Adicionar mais registros conforme necessário -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Seção de Informações Adicionais -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Informações Adicionais</h2>
            <div class="border p-4 rounded bg-gray-100">
                <p><strong>Alergias:</strong> Nenhuma</p>
                <p><strong>Medicamentos:</strong> Medicamento X (dosagem diária)</p>
                <p><strong>Histórico de Doenças:</strong> Nenhuma doença grave registrada</p>
            </div>
        </div>

        <!-- Seção de Documentos e Receitas -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Documentos e Receitas</h2>
            <ul class="list-disc pl-6">
                <li><a href="link-para-receita.pdf" class="text-blue-500 hover:underline">Receita de Medicamento - 01/09/2024</a></li>
                <li><a href="link-para-relatorio.pdf" class="text-blue-500 hover:underline">Relatório de Exames - 15/08/2024</a></li>
            </ul>
        </div>

        <!-- Seção de Comentários e Feedback -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Comentários e Feedback</h2>
            <form action="enviar_feedback.php" method="POST">
                <textarea name="feedback" rows="4" class="border-gray-300 border p-2 rounded w-full" placeholder="Deixe seu comentário ou feedback aqui..."></textarea>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Enviar Feedback</button>
            </form>
        </div>

        <!-- Seção de Lembretes e Notificações -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Lembretes e Notificações</h2>
            <ul class="list-disc pl-6">
                <li><span class="font-semibold">Vacinação:</span> Próxima vacina em 10/09/2024</li>
                <li><span class="font-semibold">Check-up:</span> Agendar check-up anual em outubro</li>
            </ul>
        </div>

        <!-- Seção de Galeria de Fotos -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Galeria de Fotos</h2>
            <div class="grid grid-cols-3 gap-4">
                <img src="foto1.jpg" alt="Foto do Pet" class="w-full h-auto rounded">
                <img src="foto2.jpg" alt="Foto do Pet" class="w-full h-auto rounded">
                <img src="foto3.jpg" alt="Foto do Pet" class="w-full h-auto rounded">
            </div>
        </div>

        <!-- Seção de Contato de Emergência -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Contato de Emergência</h2>
            <p>Se você precisar entrar em contato com a clínica fora do horário de atendimento, por favor, ligue para:</p>
            <p><strong>Telefone:</strong> (11) 1234-5678</p>
            <p><strong>Email:</strong> emergencia@clinicaveterinaria.com.br</p>
        </div>

        <!-- Seção de Histórico de Pagamentos -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold">Histórico de Pagamentos</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Data</th>
                            <th class="py-2 px-4 border-b">Descrição</th>
                            <th class="py-2 px-4 border-b">Valor</th>
                            <th class="py-2 px-4 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b">01/09/2024</td>
                            <td class="py-2 px-4 border-b">Consulta de Rotina</td>
                            <td class="py-2 px-4 border-b">R$ 150,00</td>
                            <td class="py-2 px-4 border-b">Pago</td>
                        </tr>
                        <!-- Adicionar mais registros conforme necessário -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>



  <script src="script.js"></script>
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

// Mostrar o popup
document.getElementById('openPopup').addEventListener('click', function () {
        document.getElementById('popupContainer').style.display = 'flex';
    });

    // Fechar o popup
    document.getElementById('closePopup').addEventListener('click', function () {
        document.getElementById('popupContainer').style.display = 'none';
    });
    </script>
</body>

</html>
