<?php

namespace Config;

class Model
{
    public $db = "";
    public $select = "";
    public $from = "";
    public $orderBy = "";
    public $where = "";
    public $limit = "";

    public function __construct()
    {
        try {
            $this->db = new \PDO("mysql:host=54.89.83.220;dbname=gasnatur", "root", "moiseslinar3s");
            //$this->db = new Database(DATABASE['TYPE'], DATABASE['HOST'], DATABASE['NAME'], DATABASE['USER'], DATABASE['PASS'], DATABASE['CHAR']);
        } catch (PDOException $e) {
            echo "Error al conectarse a la base de datos: " . $e->getMessage();

        }
    }

    public function setSelect($select){
        $this->select = $select;
        return $this;
    }

    public function setFrom($from){
        $this->from = $from;
        return $this;
    }

    public function setOrderBy($orderBy){
        $this->orderBy = $orderBy;
        return $this;
    }

    public function setWhere($where){
        $this->where = $where;
        return $this;
    }
    public function setLimit($limit){
        $this->limit = $limit;
        return $this;
    }

    public function setPaginator(){
        $res = $this->db->prepare("select SQL_CALC_FOUND_ROWS $this->select from $this->from $this->where $this->orderBy");
        //$sql = "SELECT SQL_CALC_FOUND_ROWS $this->select FROM {$this->from} WHERE {$this->where} {$this->orderBy} LIMIT $inicio,$regpagina";
        $res->execute();
        return $res->fetchAll();
    }
}

?>