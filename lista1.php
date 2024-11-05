<?php
require 'configPDO.php';

// Buscar informações do medicamento
$sql = "SELECT * FROM medicamentos";
$listaMedicamentos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $preco_custo = $_POST['preco_custo'];
    $preco_venda = $_POST['preco_venda'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $data_validade = $_POST['data_validade'];

    // Prepara a consulta SQL para inserir os dados
    $sql = "INSERT INTO medicamentos (nome, preco_custo, preco_venda, quantidade, categoria, data_validade) VALUES (:nome, :preco_custo, :preco_venda, :quantidade, :categoria, :data_validade)";
    $stmt = $pdo->prepare($sql);

    // Vincula os parâmetros
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco_custo', $preco_custo);
    $stmt->bindParam(':preco_venda', $preco_venda);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':data_validade', $data_validade);

    // Executa a consulta
    if ($stmt->execute()) {
        $sucesso = "Medicamento cadastrado com sucesso!";
    } else {
        $erro = "Erro ao cadastrar o medicamento.";
    }
}
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Medicamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Medicamentos</h2>
        
        <!-- Tabela de Medicamentos -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço de Custo</th>
                    <th>Preço de Venda</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                    <th>Data de Validade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaMedicamentos as $med): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($med['nome']); ?></td>
                        <td><?php echo htmlspecialchars($med['preco_custo']); ?></td>
                        <td><?php echo htmlspecialchars($med['preco_venda']); ?></td>
                        <td><?php echo htmlspecialchars($med['quantidade']); ?></td>
                        <td><?php echo htmlspecialchars($med['categoria']); ?></td>
                        <td><?php echo htmlspecialchars($med['data_validade']); ?></td>
                        <td>
                            <!-- Botão Editar -->
                            <a href="editar.php?id=<?php echo $med['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <!-- Botão Excluir -->
                            <form action="excluir.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $med['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button><br><br><br>
                                
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <a href="menu.php" class="btn btn-default btn-lg active" role="button">Ir para o menu</a><br><br>
            </tbody>
        </table>
    </div>
</body>
</html>