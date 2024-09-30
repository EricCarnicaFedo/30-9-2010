<?php
session_start(); // Inicia a sessão
?>
<!DOCTYPE html>

<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!----======== CSS ======== -->
  <link rel="stylesheet" href="carrossel.css">
  <link rel="stylesheet" href="veterinario.css">
  <link rel="stylesheet" href="inicio.css">
  <link rel="stylesheet" href="style.css">

  <!---------========= fontes =========------->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
  <!----===== Boxicons CSS ===== -->

  <script src="https://cdn.tailwindcss.com"></script>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

  <!--<title>Dashboard Sidebar Menu</title>-->
</head>


<header id="navbar" class="flex justify-between items-center text-white p-4">
    <nav>
        <div class="titulonavbar">
            <i class="bx bxs-animal-paw"></i>
            <span class="text">Veterinário</span>
        </div>
        <ul class="navbarconteudo">
            <!-- Manter apenas os itens desejados -->
        </ul>
    </nav>

    <div class="flex items-center space-x-4">
        <!-- Verifica se o nome do usuário está na sessão -->
        <span class="hidden md:inline-block">Bem-vindo, <?= htmlspecialchars(isset($_SESSION['nome_usuario']) ? $_SESSION['nome_usuario'] : 'Usuário'); ?></span>

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
    <i class='bx bx-home-alt' style="font-size: 40px; color: white;  "></i>
    <h2>GestaoVet</h2>
    <!-- Ícone de exemplo -->
  </div>
  <a href="javascript:void(0)" class="closebtn" id="close-sidebar"> <i class='bx bxs-chevron-right'></i></a>
  
  <a href="#"><i class="bx bx-home"></i>
    <pan class="sidebar-text">Início</span>
  </a>
  <a href="notificacoes.php"><i class='bx bx-bell'></i> <span class="sidebar-text">Notificações</span></a>
  <a href="#"><i class='bx bxs-user'></i> <span class="sidebar-text">Analíticas</span></a>

  <a href="agenda.php"><i class='bx bx-calendar'></i> <span class="sidebar-text">Agenda</span></a>
  <a href="pets.php"><i class='bx bxs-cat'></i> <span class="sidebar-text">Pets</span></a>
  <a href="historico.php"><i class='bx bxs-time'></i> <span class="sidebar-text">Historico</span></a>
  <a href="cadastroteste.php"><i class='bx bxs-file-plus'></i> <span class="sidebar-text">Cadastros</span></a>
  <a href="logout.php" style="margin-top: 100px;">
  <i class='bx bx-log-out'></i> <span class="sidebar-text">Sair</span>
</a>


  <a href="#"><i class='bx bx-moon theme-toggle' id="theme-toggle"></i> <span
      class="sidebar-text  tema   ">Tema</span></a>

</div>


</div>

<body>


  </main>

  </section>


  </nav>



  </div>


  </div>
  </img>
  </main>
  </div>
  <section id="home-section" class="custom-welcome-section" style="background-image: url('https://i.postimg.cc/kXL4WgSD/variedade-de-alimentos-para-animais-de-estimacao.jpg');">
    <div class="custom-container">
      <div class="custom-welcome-text">
        <h1>Painel do Veterinário</h1>
        <p>Bem-vindo ao painel de controle. Selecione uma função abaixo para gerenciar a clínica.</p>
        <a href="login.php" class="cta-button">Comece Agora</a>
      </div>
    </div>
</section>

  <div class="notifications">
    <div class="notification-item" onclick="verNotificacoes()">
        <i class='bx bxs-bell'></i>
        <span>Você tem 3 novos agendamentos!</span>
    </div>
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

  <div class="stats">
    <div class="stat-card">
      <i class='bx bxs-calendar-check'></i>
      <h3>Consultas Realizadas</h3>
      <p><?php echo $totalPacientes; ?></p>
    </div>
    <div class="stat-card">
      <i class='bx bxs-user-check'></i>
      <h3>Novos Clientes</h3>
      <p><?php echo $totalTratamentosAndamento; ?></p>
    </div>
    <div class="stat-card">
      <i class='bx bxs-capsule'></i>
      <h3>Tratamentos Realizados</h3>
      <p><?php echo $totalConsultasHoje; ?></p>
  </div>
  </div>

  <div class="vet-container">
        <div class="vet-options-grid">
            <div class="vet-option-card" onclick="irPara('consultas_agendadas')">
                <div class="vet-icon">
                    <i class='bx bxs-calendar-check'></i>
                </div>
                <h2>Consultas Agendadas</h2>
                <p>Veja e gerencie as consultas programadas para os próximos dias.</p>
            </div>

            <div class="vet-option-card" onclick="irPara('clientes_pets')">
                <div class="vet-icon">
                    <i class='bx bxs-user-detail'></i>
                </div>
                <h2>Clientes e Pets</h2>
                <p>Acesse as informações dos clientes e seus pets, incluindo histórico médico.</p>
            </div>

            <div class="vet-option-card" onclick="irPara('estoque_medicamentos')">
                <div class="vet-icon">
                    <i class='bx bxs-capsule'></i>
                </div>
                <h2>Medicamentos pre-escritos</h2>
                <p>Controle o estoque de medicamentos e materiais médicos da clínica.</p>
            </div>

            <div class="vet-option-card" onclick="irPara('financeiro')">
                <div class="vet-icon">
                    <i class='bx bxs-wallet'></i>
                </div>
                <h2>Relatórios Financeiros</h2>
                <p>Gere e visualize relatórios financeiros da clínica.</p>
            </div>

            <div class="vet-option-card" onclick="irPara('gestao_equipe')">
                <div class="vet-icon">
                    <i class='bx bxs-group'></i>
                </div>
                <h2>Gestão da Equipe</h2>
                <p>Gerencie sua equipe de veterinários, assistentes e funcionários.</p>
            </div>

            <div class="vet-option-card" onclick="irPara('configuracoes')">
                <div class="vet-icon">
                    <i class='bx bxs-cog'></i>
                </div>
                <h2>Configurações</h2>
                <p>Altere as configurações e preferências da clínica.</p>
            </div>
        </div>
    </div>

    <script>
        function irPara(opcao) {
            alert("Você escolheu: " + opcao);
        }
    </script>
  <section id="services-section" class="custom-services-section">
    <div class="custom-container">
      
</div>
</section>

  <footer class="footer">
    <div class="footer-content">
      <h2 class="footer-title">Gestão Veterinária</h2>
      <p class="footer-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at sapien eu justo ultrices
        feugiat at id quam. Vivamus eu tellus vel ex pretium hendrerit. Phasellus eget vehicula ex, sit amet dictum
        felis.</p>
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
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at sapien eu justo ultrices feugiat at id
          quam. Vivamus eu tellus vel ex pretium hendrerit. Phasellus eget vehicula ex, sit amet dictum felis.</p>
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
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris at sapien eu justo ultrices feugiat at id
          quam. Vivamus eu tellus vel ex pretium hendrerit. Phasellus eget vehicula ex, sit amet dictum felis.</p>
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
    document.getElementById('customize-button').addEventListener('click', function () {
      this.classList.toggle('rotated'); // Adiciona ou remove a classe 'rotated' ao clicar
    });
    document.addEventListener('DOMContentLoaded', function () {
      var conteudo = document.querySelector('.conteudo');
      setTimeout(function () {
        conteudo.classList.add('entrou');
      }, 500); // Ajuste o tempo conforme necessário
    });
    function verNotificacoes() {
    alert("Você clicou na notificação. Aqui você pode redirecionar para uma página de detalhes ou abrir um modal com mais informações.");
}


  </script>

</body>

</html>