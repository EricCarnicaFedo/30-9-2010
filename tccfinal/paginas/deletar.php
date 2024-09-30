<?php
require("classecliente.php");
$cliente = new Cliente();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $cliente->deletar($id); // Supondo que tenha um método para deletar
    header("Location: agenda.php"); // Redireciona após a exclusão
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Deletar Cliente</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<main class="p-6">
    <div class="bg-white p-6 rounded shadow-md">
        <h1 class="text-xl font-bold mb-4">Deletar Cliente</h1>
        <form method="POST">
            <p class="mb-4">Tem certeza que deseja deletar este cliente?</p>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded flex items-center">
                <i class="bx bxs-trash mr-2"></i> Deletar
            </button>
            <a href="agenda.php" class="bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center ml-4">
                <i class="fas fa-arrow-left mr-2"></i> Cancelar
            </a>
        </form>
    </div>
</main>
</body>
</html>
