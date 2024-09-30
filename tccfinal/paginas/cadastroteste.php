<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="cadastro.css">
    <title>Pagina de Cadastro</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up"></div>
        <div class="form-container sign-in">
        <form id="myForm" action="process_form.php" method="POST">
    <h1 class="titulo-pequeno">Cadastro de Dados</h1>

    <span>Selecione a tabela na qual deseja adicionar o conteúdo.</span>
    <select name="tabela" id="tabela" class="custom-select">
        <option value="pacientes">Pacientes</option>
        <option value="historico_vacinas">Histórico de Vacinas</option>
        <option value="exames_realizados">Exames Realizados</option>
        <option value="medicamentos_prescritos">Medicamentos Prescritos</option>
        <option value="tutores">Tutores</option>
        <option value="tratamentos">Tratamentos</option>
    </select>

    <div id="dynamicFields"></div>

    <button type="submit">Inserir</button>
    <div id="alertMessage" style="display:none; color: green; margin-top: 10px;"></div>
</form>
        </div>
        <div class="toggle-container"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.2/boxicons.min.js"></script>
    <script>
        const tableFields = {
            pacientes: {
                fields: ['Nome do Animal', 'Raça', 'Proprietário', 'Data de Nascimento', 'Idade', 'Sexo'],
                paddingBottom: '800px'
            },
            historico_vacinas: {
                fields: ['Nome do Animal', 'Vacina', 'Data da Aplicação', 'Veterinário'],
                paddingBottom: '700px'
            },
            exames_realizados: {
                fields: ['Nome do Animal', 'Tipo de Exame', 'Data do Exame', 'Resultado'],
                paddingBottom: '600px'
            },
            medicamentos_prescritos: {
                fields: ['Nome do Animal', 'Medicamento', 'Data da Prescrição', 'Dosagem'],
                paddingBottom: '700px'
            },
            tutores: {
                fields: ['ID do Tutor', 'Nome do Tutor', 'Email', 'Telefone', 'Endereço', 'Cidade', 'Estado', 'CEP'],
                paddingBottom: '800px'
            },
            tratamentos: {
                fields: ['Nome do Animal', 'Tipo de Tratamento', 'Data do Tratamento', 'Resultado', 'Status'],
                paddingBottom: '800px'
            }
        };

        document.getElementById('tabela').addEventListener('change', function() {
            const selectedTable = this.value;
            const container = document.getElementById('container');
            const dynamicFields = document.getElementById('dynamicFields');
            const { fields, paddingBottom } = tableFields[selectedTable] || { fields: [], paddingBottom: '480px' };

            dynamicFields.classList.remove('show');

            setTimeout(() => {
                dynamicFields.innerHTML = '';

                fields.forEach((field, index) => {
                    const fieldGroup = document.createElement('div');
                    fieldGroup.className = 'form-group';

                    const label = document.createElement('label');
                    label.textContent = field;
                    label.setAttribute('for', 'field' + (index + 1));

                    let input;
                    if (field === 'Data de Nascimento' || field === 'Data da Aplicação' || field === 'Data do Exame') {
                        input = document.createElement('input');
                        input.type = 'date';
                        input.id = 'field' + (index + 1);
                        input.name = 'field' + (index + 1);
                        input.className = 'custom-input';
                        input.placeholder = 'Selecione a data';

                        // Adiciona o ícone ao lado do campo de data
                        const icon = document.createElement('i');
                        icon.className = 'bx bx-calendar';
                        icon.style.marginLeft = '10px';
                        fieldGroup.appendChild(icon);
                    } else {
                        input = document.createElement('input');
                        input.type = 'text';
                        input.id = 'field' + (index + 1);
                        input.name = 'field' + (index + 1);
                        input.className = 'custom-input';
                    }

                    fieldGroup.appendChild(label);
                    fieldGroup.appendChild(input);
                    dynamicFields.appendChild(fieldGroup);
                });

                setTimeout(() => {
                    dynamicFields.classList.add('show');
                }, 10);

                container.style.paddingBottom = paddingBottom;
            }, 300);

            // Inicializa o Flatpickr para campos de data
            const dateFields = document.querySelectorAll('#dynamicFields input[placeholder="Selecione a data"]');
            dateFields.forEach(field => {
                flatpickr(field, {
                    dateFormat: "Y-m-d"
                });
            });
        });

        document.getElementById('tabela').dispatchEvent(new Event('change'));
    </script>
</body>
</html>
