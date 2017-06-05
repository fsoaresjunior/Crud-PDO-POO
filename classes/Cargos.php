<?php

require_once 'Crud.php';

class Cargos extends Crud
{
    protected $table = 'cargos';
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function setNome($nome)
    {
        $this->parans['cargo'] = $nome;
    }

    public function findByNome($nome){
        $sql = "SELECT * FROM $this->table WHERE cargo = :nome";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

}
