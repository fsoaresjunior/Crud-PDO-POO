<?php

require_once 'Crud.php';

class Cargos extends Crud
{
    protected $table = 'cargos';
    private $nome;

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function insert()
    {
        $sql  = "INSERT INTO $this->table (cargo) VALUES (:nome)";
        $stmt = DB::prepare($sql);

        $stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function findByNome($nome){
        $sql = "SELECT * FROM $this->table WHERE cargo = :nome";
        $stmt = DB::prepare($sql);
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function update($id)
    {
        $sql  = "UPDATE $this->table SET cargo = :nome WHERE id = :id";
        $stmt = DB::prepare($sql);

        $stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

}
