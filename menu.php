<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Adicionado para responsividade -->
    <title>Menu Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Menu Principal</h2>
        <div class="list-group">
            <a href="cadastrar.php" class="list-group-item list-group-item-action">Cadastrar Medicamento</a>
            <a href="listar1.php" class="list-group-item list-group-item-action">Editar/Excluir Medicamento</a>
            <a href="listar_estatico.php" class="list-group-item list-group-item-action">Verificar Estoque</a>
            <br><br>
            <a href="listar_estatico.php" class="btn btn-secondary btn-lg active" role="button">Pular direto para o estoque</a>
            <a href="menu.php" class="btn btn-secondary btn-lg active" role="button">Ir para o menu</a><br><br>
        </div>
    </div>
</body>
</html>