// Abrir e Fechar o Formulário de Adicionar Pet
function openAddPetForm() {
  document.getElementById("addPetForm").style.display = "flex";
}

function closeAddPetForm() {
  document.getElementById("addPetForm").style.display = "none";
}

// Abrir e Fechar o Modal de Detalhes do Pet
function viewPetDetails(petId) {
  // Requisita detalhes do pet via AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("GET", `get_pet_details.php?id=${petId}`, true);
  xhr.onload = function() {
      if (this.status === 200) {
          const petDetails = JSON.parse(this.responseText);
          let detailsHtml = `
              <h3>Exames Realizados</h3>
              ${petDetails.exames.map(exame => `<p>${exame.tipoExame} - ${exame.dataExame} - Resultado: ${exame.resultado}</p>`).join('')}
              <h3>Medicamentos Prescritos</h3>
              ${petDetails.medicamentos.map(med => `<p>${med.medicamento} - ${med.dataPrescricao} - Dosagem: ${med.dosagem}</p>`).join('')}
              <h3>Vacinas</h3>
              ${petDetails.vacinas.map(vacina => `<p>Vacina: ${vacina.idVacina} - Aplicado em: ${vacina.dataAplicacao}</p>`).join('')}
              <h3>Tratamentos</h3>
              ${petDetails.tratamentos.map(tratamento => `<p>${tratamento.descricao} - Início: ${tratamento.data_inicio} - Fim: ${tratamento.data_fim}</p>`).join('')}
          `;
          document.getElementById("pet-details").innerHTML = detailsHtml;
          document.getElementById("petDetailsModal").style.display = "flex";
      }
  };
  xhr.send();
}

function closePetDetailsModal() {
  document.getElementById("petDetailsModal").style.display = "none";
}
