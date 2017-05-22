<?php

require_once 'Crud.php';

class Cargos extends Crud
{
    protected $table = 'cargos';

    public function setNome($nome)
    {
        $this->parans['cargo'] = $nome;
    }

    public function findByNome($nome){
        $sql = "SELECT * FROM $this->table WHERE cargo = :nome";
        $stmt = DB::prepare($sql);
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

}
