<?php

namespace Config;

class Model
{
    public $db = "";
    public $select = "";
    public $from = "";
    public $orderBy = "";
    public $where = "";
    public $setUpdate = "";
    public $page = 1;

    public function __construct()
    {
        try {
            $this->db = new \PDO("mysql:host=54.89.83.220;dbname=gasnatur", "root", "moiseslinar3s");
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

    public function setPage($page){
        $this->page = $page;
        return $this;
    }

    public function update($update){
        $this->setUpdate = $update;
        return $this;
    }

    public function setPaginator(){
        $pagina = 1;
        $regpagina = 5;
        $palabraBuscada  = '';

        $resultado = [];
        $inicio = ($pagina >= 1) ? (($pagina * $regpagina) - $regpagina) : 0;

        $registros = $this->db->prepare("select SQL_CALC_FOUND_ROWS $this->select from $this->from $this->where $this->orderBy LIMIT $inicio,$regpagina");
        $registros->execute();
        $registros = $registros->fetchAll(\PDO::FETCH_OBJ);

        $totalregistros = $this->db->query("SELECT FOUND_ROWS() as total");
        $totalregistros = $totalregistros->fetch()['total'];

        $numeropaginas = ceil($totalregistros / $regpagina);

        $resultado["registros"] = $registros;
        $resultado["inicio"] = $inicio +1 ;
        if($totalregistros < $regpagina){
            $resultado["fin"] = $inicio + $totalregistros;
        }
        else{
            $resultado["fin"] = $inicio + $regpagina;
        }
        $resultado["totalregistros"] = $totalregistros;
        $resultado["pagina"] = intval($pagina);

        if($pagina >= $numeropaginas){
            $resultado["pagina_anterior"] = $pagina - 1;
            $resultado["pagina_posterior"] = 0;
        } elseif(0 < $pagina && $pagina <= $numeropaginas){
            $resultado["pagina_anterior"] = $pagina -1;
            $resultado["pagina_posterior"] = $pagina + 1;
        }
        $resultado["palabra_buscada"] = $palabraBuscada;

        return $resultado;
    }

    public function setEdit($id){
        $res = $this->db->prepare("select $this->select  FROM $this->from WHERE id=$id");
        $res->execute();
        return $res->fetch(\PDO::FETCH_ASSOC);
    }
    public function setUpdate($id){
        $res = $this->db->prepare();
        $res->execute();
    }
    public function finsert($table, array $data)
    {
        ksort($data);
        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));
        $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $stm = $sth->execute();
        return $stm;
    }

    public function fupdate($table, array $data, $id)
    {

        ksort($data);

        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }

        $fieldDetails = rtrim($fieldDetails, ',');

        $sth = $this->db->prepare("UPDATE {$table} SET $fieldDetails WHERE id={$id}");
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $stm = $sth->execute();
        return $stm;

        return $fieldDetails;
    }

}

?>