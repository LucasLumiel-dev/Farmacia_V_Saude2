<?php
/*
require "configPDO.php";
date_default_timezone_set('America/Sao_Paulo'); //define um fuso horario padão para o data_cadastro

class usuario
{   private $ID_usuario;
    private $Nome_usuario;
    private $email;
    private $senha;
    private $tipo;
    private $data_de_cadastro;

    function __construct($ID_usuario, $email, $senha, $tipo, $data_de_cadastro)
    {   //sanitiza os dados para evitar ataques XSS
        $this->$ID_usuario = $ID_usuario;
        $this->email = htmlspecialchars($email);
        $this->senha =  password_hash(htmlspecialchars($senha), PASSWORD_DEFAULT); // Criptografa a senha para armazenamento seguro. usar password_verify para comparar senhas
        $this->tipo = htmlspecialchars(strtoupper($tipo)); //no banco o tipo é um string em upper case
        $this->data_de_cadastro = htmlspecialchars(date('Y-m-d H:i:s')); //ver se funciona no sql
    }

    //cadastra um usuario se não hover um email cadastrato com o mesmo tipo
    function cadastrar(usuario $u)
    {
        $c = new config();
        $pdo = $c->getPDO();
        //consulta se o email com esse tipo já esta cadastrado
        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND tipo = :tipo");
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':tipo', $u->tipo);

        if ($sql->rowCount() == 0) {
            //cadastra novo usuario
            $sql = $pdo->prepare("INSERT INTO usuarios (email, senha, tipo, data_de_cadastro) VALUES (:email, :senha, :tipo, :data_de_cadastro);");
            $sql->bindValue(':email', $u->email);
            $sql->bindValue(':senha', $u->senha);
            $sql->bindValue(':tipo', $u->tipo);
            $sql->bindValue(':data_de_cadastro', $u->data_de_cadastro);

            $sql->execute();
            return $u;
        } else {
            // email com tipo já cadastrado
            return false;
        }        
    }
    // realiza login apos validar cadastro no banco de dados
    function login(usuario $u, $senha_digitada)
    {
        $senha_digitada = password_hash(htmlspecialchars($senha_digitada), PASSWORD_DEFAULT);
        $c = new config();
        $pdo = $c->getPDO();

        $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha AND tipo = :tipo");
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':senha', $u->senha);
        $sql->bindValue(':tipo', $u->tipo);

        $sql->execute();
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($senha_digitada, $usuario['senha'])) {
            //login com sucesso
            return $usuario;
        } else {
            // email ou senha incorretos
            return false;
        }
    }
}
