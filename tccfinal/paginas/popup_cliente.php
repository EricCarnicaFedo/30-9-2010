
<div id="popup" class="popup" style="display: none;">
    <div class="popup-content">
        <span class="close-btn" onclick="fecharPopup()" style="cursor: pointer;">
            <i class='bx bx-x'></i> <!-- Ícone de fechar -->
        </span>
        <h2 class="popup-title">Editar Cliente</h2>

        <form id="formPopup" method="POST" action="salvar_cliente.php">
            <input type="hidden" name="id" value="">
            
            <div class="input-group">
                <label for="nome">Nome:</label>
                <div class="input-with-icon">
                    <i class='bx bx-user'></i>
                    <input type="text" name="nome" required>
                </div>
            </div>

            <div class="input-group">
                <label for="email">Email:</label>
                <div class="input-with-icon">
                    <i class='bx bx-envelope'></i>
                    <input type="email" name="email" required>
                </div>
            </div>

            <div class="input-group">
                <label for="telefone">Telefone:</label>
                <div class="input-with-icon">
                    <i class='bx bx-phone'></i>
                    <input type="text" name="telefone" required>
                </div>
            </div>

            <div class="input-group">
                <label for="endereco">Endereço:</label>
                <div class="input-with-icon">
                    <i class='bx bx-home'></i>
                    <input type="text" name="endereco" required>
                </div>
            </div>

            <div class="input-group">
                <label for="cidade">Cidade:</label>
                <div class="input-with-icon">
                    <i class='bx bx-building-house'></i>
                    <input type="text" name="cidade" required>
                </div>
            </div>

            <div class="input-group">
                <label for="estado">Estado:</label>
                <div class="input-with-icon">
                    <i class='bx bx-map'></i>
                    <input type="text" name="estado" required>
                </div>
            </div>

            <div class="input-group">
                <label for="cep">CEP:</label>
                <div class="input-with-icon">
                    <i class='bx bx-credit-card'></i>
                    <input type="text" name="cep" required>
                </div>
            </div>

            <div class="button-container">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</div>

<script>
function fecharPopup() {
    document.getElementById("popup").style.display = "none";
}

function abrirPopup(idCliente, nome, email, telefone, endereco, cidade, estado, cep) {
    document.querySelector('input[name="id"]').value = idCliente;
    document.querySelector('input[name="nome"]').value = nome;
    document.querySelector('input[name="email"]').value = email;
    document.querySelector('input[name="telefone"]').value = telefone;
    document.querySelector('input[name="endereco"]').value = endereco;
    document.querySelector('input[name="cidade"]').value = cidade;
    document.querySelector('input[name="estado"]').value = estado;
    document.querySelector('input[name="cep"]').value = cep;

    document.getElementById("popup").style.display = "block"; // Abre o popup
}
</script>




<style>
.popup {
    display: none; /* Mantenha oculto inicialmente */
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgba(0, 0, 0, 0.4); 
}

.popup-content {
    background-color: #fefefe;
    margin: 10% auto; /* Ajuste a margem superior */
    padding: 15px; /* Reduzir o preenchimento */
    border: 1px solid #888;
    width: 300px; /* Defina uma largura menor */
    border-radius: 5px; /* Adiciona bordas arredondadas */
    position: relative; /* Para posicionar o botão de fechar */
}

.popup-content .close-btn {
    color: #aaa;
    position: absolute; /* Posiciona dentro do container */
    right: 10px;
    top: 10px;
    font-size: 20px;
    font-weight: bold;
}

.popup-content .close-btn:hover,
.popup-content .close-btn:focus {
    color: black;
    cursor: pointer;
}

.input-group {
    margin-bottom: 10px; /* Espaçamento abaixo dos campos */
}

.input-with-icon {
    position: relative; /* Para posicionar o ícone */
}

.input-with-icon i {
    position: absolute; /* Posiciona o ícone */
    left: 10px;
    top: 50%;
    transform: translateY(-50%); /* Centraliza verticalmente */
    color: #888; /* Cor do ícone */
}

.popup-content label {
    display: block;
    margin: 5px 0; /* Reduzir o espaço entre rótulos e campos */
}

.popup-content input {
    width: 100%; /* Garante que todos os inputs tenham a mesma largura */
    padding: 5px 30px; /* Reduzir o preenchimento dos campos, considerando o ícone */
    border: 1px solid #ccc;
    border-radius: 4px;
}

.popup-content button {
    width: auto; /* Ajuste a largura do botão */
    padding: 5px 10px; /* Reduzir o preenchimento do botão */
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px; /* Bordas arredondadas para o botão */
    cursor: pointer;
}

.popup-content button:hover {
    background-color: #45a049;
}
.close-btn {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close-btn:hover,
.close-btn:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.popup-title {
    text-align: center; /* Centraliza o texto */
    font-weight: bold;  /* Deixa o texto em negrito */
    margin: 10px 0;    /* Adiciona um pouco de espaço acima e abaixo */
}

.button-container {
    text-align: center; /* Centraliza o conteúdo dentro da div */
    margin-top: 10px;  /* Adiciona um espaço acima do botão */
}


</style>
