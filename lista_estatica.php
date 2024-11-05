<?php
require 'configPDO.php';

// Buscar informações do medicamento
$sql = "SELECT * FROM medicamentos";
$listaMedicamentos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Informações dos Medicamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Informações dos Medicamentos</h2>
        
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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Botão para voltar ao menu -->
        <a href="menu.php" class="btn btn-default btn-lg active" role="button">Ir para o menu</a><br><br>
    </div>
</body>
</html>