<?php
require "configPDO.php";

class produtos
{

    private $ID_medi;
    private $Nome_medi;
    private $preco_unitario;
    private $quantidade;
    private $categoria;
    private $data_de_validade;

    function __construct($ID_medi , $Nome_medi, $preco_unitario, $quantidade, $categoria, $data_de_validade)
    {
        $this->ID_medi = $ID_medi;
        $this->Nome_medi = htmlspecialchars($Nome_medi);
        $this->preco_unitario = htmlspecialchars($preco_unitario);
        $this->quantidade = htmlspecialchars($quantidade);
        $this->categoria = htmlspecialchars($categoria);
        $this->data_de_validade = htmlspecialchars($data_de_validade);
    }

    function cadastrarProduto(produtos $p)
    {

        $c = new config();
        $pdo = $c->getPDO();

        $sql = $pdo->prepare("SELECT * FROM produtos WHERE nome = :nome AND categoria = :categoria;");
        $sql->bindValue(':nome', $p->Nome_medi);
        $sql->bindValue(':categoria', $p->categoria);

        if (!$sql->execute()) {
            // caso haja uma falha na conexão
            echo '<script>console.log("falha na conexão com o banco")</script>';
            return false;
        }
        if ($sql->rowCount() > 0) {
            // produto com nome e categoria já cadastradas
            return false;
        } else {
            //cadastra o produto novo 
            $sql = $pdo->prepare("INSERT INTO produtos (Nome_medi, preco_unitario, quantidade, categoria, data_de_validade) VALUES (:Nome_medi, :preco_unitario, :quantidade, :categoria, :data_de_validade);");
            $sql->bindValue(':Nome_medi', $p->Nome_medi);
            $sql->bindValue(':preco_unitario', $p->preco_unitario);
            $sql->bindValue(':quantidade', $p->quantidade);
            $sql->bindValue(':categoria', $p->categoria);
            $sql->bindValue(':data_de_validade', $p->data_de_validade);

            if ($sql->execute()) {
                // cadastrardo com sucesso 
                echo "funcionou";
                return true;
            } else {
                //cadastro falhou
                echo '<script>console.log("falha na conexão com o banco")</script>';
                return false;
            }
        }
    }

    function retornaTodosProdutos() //retorna os protudos cadstrados como uma lista ordenada
    {
        $c = new config();
        $pdo = $c->getPDO();

        $sql = $pdo->query("SELECT * FROM produtos");
        if (!$sql->execute()) {
            echo '<script>console.log("falha na conexão com o banco")</script>';
            return false;
        }

        if ($sql->rowCount() > 0) {
            $lista = [];
            $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $lista;
        } else {
            // houve algum erro na conexão com o banco
            echo '<script>console.log("")</script>';
            return false;
        }
    }

    function retornaPorNome(produtos $p) // retorna todos regsitros encontrados com um mesmo nome
    {
        $c = new config();
        $pdo = $c->getPDO();

        $sql = $pdo->prepare("SELECT * FROM produtos WHERE Nome_medi = :Nome_medi");
        $sql->bindValue(':Nome_medi', $p->Nome_medi);

        if (!$sql->execute()) {
            echo '<script>console.log("falha na conexão com o banco")</script>';
            return false;
        }
        if ($sql->rowCount() > 0) {
            // retorna os registros encontrados
            $lista = [];
            $lista = $sql->fetchAll();
            return $lista;
        }else{
            // nome não encontrado no banco
            return false;
        }
    }
}