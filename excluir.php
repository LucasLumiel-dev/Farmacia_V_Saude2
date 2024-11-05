<?php
require 'configPDO.php'; 

// Verifica se o ID foi enviado
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Prepara a consulta para excluir
    $sql = "DELETE FROM medicamentos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: listar1.php");
        exit; // Adicione exit após header para garantir que o script pare
    } else {
        echo "Erro ao excluir: " . implode(", ", $stmt->errorInfo());
    }
} else {
    echo "ID não fornecido.";
}
?>