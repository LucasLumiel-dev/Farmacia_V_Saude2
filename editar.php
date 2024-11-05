<?php

require 'configPDO.php';

// Obter o ID do medicamento
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Buscar informações do medicamento
$sql = "SELECT * FROM medicamentos WHERE id = $id";
$medicamento = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

// Verificar se o formulário foi enviado para atualizar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $preco_custo = $_POST['preco_custo'];
    $preco_venda = $_POST['preco_venda'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $data_validade = $_POST['data_validade'];

    // Atualizar no banco de dados usando consultas preparadas
    $sql = "UPDATE medicamentos SET 
                nome = :nome, 
                preco_custo = :preco_custo, 
                preco_venda = :preco_venda, 
                quantidade = :quantidade, 
                categoria = :categoria, 
                data_validade = :data_validade 
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco_custo', $preco_custo);
    $stmt->bindParam(':preco_venda', $preco_venda);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':data_validade', $data_validade);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: listar1.php");
    } else {
        echo "Erro ao atualizar: " . implode(", ", $stmt->errorInfo());
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Medicamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Medicamento</h2>

        <!-- Formulário para Atualizar -->
        <form method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $medicamento['nome']; ?>">
            </div>
            <div class="mb-3">
                <label for="preco_custo" class="form-label">Preço de Custo:</label>
                <input type="number" class="form-control" id="preco_custo" name="preco_custo" value="<?php echo $medicamento['preco_custo']; ?>">
            </div>
            <div class="mb-3">
                <label for="preco_venda" class="form-label">Preço de Venda:</label>
                <input type="number" class="form-control" id="preco_venda" name="preco_venda" value="<?php echo $medicamento['preco_venda']; ?>">
            </div>
            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade:</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?php echo $medicamento['quantidade']; ?>">
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria:</label>
                <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $medicamento['categoria']; ?>">
            </div>
            <div class="mb-3">
                <label for="data_validade" class="form-label">Data de Validade:</label>
                <input type="date" class="form-control" id="data_validade" name="data_validade" value="<?php echo $medicamento['data_validade']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
    </div>
</body>
</html>