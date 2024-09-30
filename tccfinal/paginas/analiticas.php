<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!----======== CSS ======== -->
  <link rel="stylesheet" href="inicio.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="notificacoes.css">

  <!---------========= fontes =========------->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
  <!----===== Boxicons CSS ===== -->
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

  <!--<title>Dashboard Sidebar Menu</title>-->
</head>


  <header id="navbar">

    <nav class="">
      <div class="titulonavbar">
        <i class="fas fa-paw icon"></i>
        <span class="text">VetEtec</span>
      </div>
      <ul class="navbarconteudo">
          <li style="padding-right: 30px;"" class="text-[white] ">Página Inicial</li>
          <li style="padding-right: 30px; ">Sobre</li>
          <li style="padding-right: 30px;"></li>Serviços</li>
          <li style="padding-right: 30px;"></li>Blog</li>
          <li style="padding-right: 30px;"></li>Contato</li>
   
      <a href="tel:+1134567890" class="tel-link">LIGUE: (11) 3456-7890</a>
  </nav>

    <i class='bx bx-menu menu-button' id="menu-button" style="font-size: 30px; "></i>
    </i>
    <i class='bx bx-cog customize-button' id="customize-button" style="font-size: 20px;  "></i>
    <div id="color-picker">
      <label for="navbar-color">Choose navbar color:</label>
     
      <input type="color" id="navbar-color" name="navbar-color" value="#4CAF50">
    </div>
  </header>


  <div id="sidebar" class="sidebar">
    <div class="sidebar-header">
      <i class='bx bx-home-alt' style="font-size: 40px; color: white;  "></i>
      <h2>VetEtec</h2>
      <!-- Ícone de exemplo -->
    </div>
    <a href="javascript:void(0)" class="closebtn" id="close-sidebar"> <i class='bx bxs-chevron-right'></i></a>
    <a href="#"><i class='bx bx-search'></i> <input type="text" placeholder="pesquisar..." id="search-bar"></a>
    <a href="inicio.html"><i class="bx bx-home"></i><pan class="sidebar-text">Início</span></a>
    <a href="#"><i class='bx bx-bell'></i> <span class="sidebar-text">Notificações</span></a>
    <a href="#"><i class='bx bxs-user'></i> <span class="sidebar-text">Analíticas</span></a>

    <a href="agenda.html"><i class='bx bx-calendar'></i> <span class="sidebar-text">Agenda</span></a>
    <a href="#"><i class='bx bxs-cat'></i> <span class="sidebar-text">Pets</span></a>
    <a href="#"><i class='bx bx-dollar-circle'></i> <span class="sidebar-text">Gastos</span></a>
    <a href="#" style="margin-top: 100px;"><i class='bx bx-log-out'></i> <span class="sidebar-text">Sair</span></a>

    <a href="#"><i class='bx bx-moon theme-toggle' id="theme-toggle"></i> <span class="sidebar-text  tema   "     >Tema</span></a>

  </div>

  <body>
    <main>
        <div class="custom-container p-4 bg-white shadow mt-4 flex justify-between items-center">
            <div class="flex space-x-4">
                <button class="custom-button bg-blue-100 text-blue-700 px-4 py-2 rounded">Todas</button>
                <button class="custom-button bg-gray-100 text-gray-700 px-4 py-2 rounded">Não lidas</button>
                <button class="custom-button bg-gray-100 text-gray-700 px-4 py-2 rounded">Recentes</button>
            </div>
            <div class="flex space-x-4">
                <button class="custom-button bg-blue-600 text-white px-4 py-2 rounded">Minhas notificações <span class="bg-red-600 text-white rounded-full px-2">1</span></button>
                <button class="custom-button bg-gray-100 text-gray-700 px-4 py-2 rounded">Extranet</button>
                <button class="custom-button bg-gray-100 text-gray-700 px-4 py-2 rounded">Delegadas</button>
                <button class="custom-button bg-gray-100 text-gray-700 px-4 py-2 rounded">Seguindo <span class="bg-red-600 text-white rounded-full px-2">1</span></button>
            </div>
            <div class="flex items-center space-x-2">
                <input type="text" placeholder="Buscar" class="custom-input border px-4 py-2 rounded">
                <button class="custom-button text-gray-600"><i class="fas fa-times"></i></button>
                <button class="custom-button text-gray-600"><i class="fas fa-th-list"></i></button>
                <button class="custom-button text-gray-600"><i class="fas fa-calendar-alt"></i></button>
            </div>
        </div>

        <div class="p-4 bg-white shadow mt-4">
            <div class="descer">
            <table  id="bugado" class="customi-table min-w-full">
                <!-- ... -->

                        <tr class="w-full bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                          <th class="py-3 px-6 text-left">Notificação</th>
                          <th class="py-3 px-6 text-left">Empresa/Projeto</th>
                          <th class="py-3 px-6 text-left">Tipo de solicitação</th>
                          <th class="py-3 px-6 text-left">Fase/Etapa</th>
                          <th class="py-3 px-6 text-left">Prazo</th>
                          <th class="py-3 px-6 text-left">Tags</th>
                        </tr>
                      </thead>
                      <tbody class="text-gray-600 text-sm font-light">
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                          <td class="py-3 px-6 text-left whitespace-nowrap">#6079 Check-up mensal para Milo</td>
                          <td class="py-3 px-6 text-left">Milo - Cão Golden Retriever, 3 anos</td>
                          <td class="py-3 px-6 text-left">Vacinação anual para Milo<br>Riccardo - 05/10 - 14:45</td>
                          <td class="py-3 px-6 text-left"><span class="bg-blue-500 text-white px-2 py-1 rounded">Em execução</span></td>
                          <td class="py-3 px-6 text-left">09/10 Seg</td>
                          <td class="py-3 px-6 text-left"><span class="bg-red-500 text-white px-2 py-1 rounded">Vacinação Anual</span><span class="bg-red-500 text-white px-2 py-1 rounded">Consulta de Rotina</span></td>
                        </tr>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">#6080 Consulta de rotina para Rex</td>
                            <td class="py-3 px-6 text-left">Labrador Retriever #1234</td>
                            <td class="py-3 px-6 text-left">Consulta de rotina agendada<br>Dr. Veterinário - 05/10 - 14:57</td>
                            <td class="py-3 px-6 text-left"><span class="bg-green-500 text-white px-2 py-1 rounded">Concluída</span></td>
                            <td class="py-3 px-6 text-left">10/10 Ter</td>
                            <td class="py-3 px-6 text-left"><span class="bg-blue-500 text-white px-2 py-1 rounded">Rotina</span></td>
                          </tr>
                          
                        </tbody>
            </table>
            </div>
        </div>
    </main>
</body>
<br><br><br><br><br><br><br><br><br><br>
  
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
  

  </script>

</body>

</html>
