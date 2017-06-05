<?php

require_once 'Crud.php';

class Usuarios extends Crud
{
    protected $table = 'usuarios';

    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function setNome($nome)
    {
        $this->parans['nome'] = $nome;
    }

    public function setSenha($senha)
    {
        $this->parans['senha'] = md5($senha);
    }

    public function setCargo($cargo)
    {
        $this->parans['id_cargo'] = $cargo;
    }

    public function setEmail($email)
    {
        $conta = "/^[^0-9][a-zA-Z0-9\._-]+[@]";
        $domino = "[a-zA-Z0-9_]+([.]";
        $extensao = "[a-zA-Z0-9_]+)$/";
        $pattern = $conta.$domino.$extensao;

        if ((preg_match($pattern, $email))) {
            $this->parans['email'] = $email;

            return true;
        } else {
            return false;
        }
    }

    public function findInnerJoin($id)
    {
        $sql  = "SELECT *, $this->table.id AS user_id FROM $this->table
                 INNER JOIN cargos ON ( usuarios.id_cargo = cargos.id)
                 WHERE usuarios.id = :id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function findAllInnerJoin()
    {
      $sql  = "SELECT *, $this->table.id AS user_id FROM $this->table
               INNER JOIN cargos ON ( usuarios.id_cargo = cargos.id)";
        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function findByEmail($email){
        $sql = "SELECT * FROM $this->table WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
}
