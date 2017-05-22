<?php

require_once 'DB.php';

abstract class Crud extends DB
{
    protected $table;

    protected $parans = [];

    public function insert()
    {
        try {
            $keys = array_keys($this->parans);
            $fields = '`'.implode('`, `',$keys).'`';

            $placeholder = substr(str_repeat('?,',count($keys)),0,-1);

            $sql = "INSERT INTO $this->table ($fields) VALUES($placeholder)";

            $stmt = DB::prepare($sql);

            return $stmt->execute(array_values($this->parans));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($id)
    {
        try {

            $keys = array_keys($this->parans);
            $sql  = "UPDATE $this->table SET ";
            $i = 0;
            foreach ($keys as $key => $value) {
              $i++;
              $sql .= $i < sizeof($this->parans)? $value." = :".$value.", " :
                                                  $value." = :".$value." ";
            }
            $sql .="WHERE id = :id";
            $stmt = DB::prepare($sql);

            foreach ($keys as $key => $value)
            {
              $stmt->bindValue(':'.$value, $this->parans[$value]);
            }

            $stmt->bindValue(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function find($id)
    {
        $sql  = "SELECT * FROM $this->table WHERE id = :id";
        $stmt = DB::prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function findAll()
    {
        $sql  = "SELECT * FROM $this->table";
        $stmt = DB::prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function delete($id)
    {
        $sql  = "DELETE FROM $this->table WHERE id = :id";
        $stmt = DB::prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
