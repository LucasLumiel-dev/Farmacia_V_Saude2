<?php
class Config
{
    private $dsn;
    private $username;
    private $password;
    private $pdo;

    public function __construct()
    {
        $this->dsn = "mysql:dbname=BdVidaSaudavel;host=localhost:3306";
        $this->username = "root";
        $this->password = "cimatec"; //OgtoQmorr10#000***
        $this->pdo = new PDO($this->dsn, $this->username, $this->password);
    }

    public function getPDO()
    {
        return $this->pdo;
    }

    public function __destruct()
    {
        $this->pdo = null;
    }
}
 
    try {
        //code...
        $pdo = new PDO("mysql:dbname=coisa;host=localhost:3306", "root", "cimatec");
    } catch (exception $e) {
        //throw $th;
        echo "Erro ao conectar ao banco" . $e->getmesage()
    }
    if ($pdo) {
        # code...
        echo "Deu certo"
    }
?>