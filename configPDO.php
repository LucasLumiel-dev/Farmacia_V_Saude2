<?php 
// Criando a conexão
$pdo = new PDO("mysql:dbname=Farmacia_V_Saude2;host=localhost:3306","root","cimatec");
if ($pdo){
    echo "Banco conectado";
}
 
    try {
        //code...
        $pdo = new PDO("mysql:dbname=coisa;host=localhost:3306", "root", "cimatec");
    } catch (exception $e) {
        //throw $th;
        echo "Erro ao conectar ao banco" . $e->getmesage();
    } if ($pdo) {
        # code...
        echo "Deu certo";
    }
?>