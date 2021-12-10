<?php

namespace Config;

class Database extends \PDO
{
    public function __construct($DBTYPE, $DBHOST, $DBNAME, $DBUSER, $DBPASS, $CHAR)
    {
        $OPCIONES = array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $CHAR);
        parent::__construct($DBTYPE . ':host=' . $DBHOST . ';dbname=' . $DBNAME, $DBUSER, $DBPASS, $OPCIONES);
        parent::setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    //listar todos
    public function findAll($sql, $array = [], $fetchMode = \PDO::FETCH_OBJ)
    {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }
    //listar uno (where)
    public function find($sql, $array = [], $fetchMode = \PDO::FETCH_OBJ)
    {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
        return $sth->fetch($fetchMode);
    }

    //pagnacion¿?
    protected function numRows($sql, $array = [])
    {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
        return $sth->rowCount();
    }

    public function paginator($table, $pagina,$q,$array = [],$fetchMode = \PDO::FETCH_OBJ)
    {
        $regpagina = 15;

        $inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;


        if($q == ""){
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM $table LIMIT $inicio,$regpagina";
        }

        

        else{
            $sql ="SELECT SQL_CALC_FOUND_ROWS * FROM $table WHERE $q LIMIT $inicio,$regpagina";
  
        }

        return $sql;

        $registros = $this->prepare($sql);
     
        foreach ($array as $key => $value) {
             $registros->bindValue("$key", $value);
         }

        $registros->execute();
        $registros =$registros->fetchAll($fetchMode);

        $totalregistros = $this->query("SELECT FOUND_ROWS() as total");
        $totalregistros = $totalregistros->fetch()['total'];

        $numeropaginas = ceil($totalregistros / $regpagina);
        
        $resultado =[];
        $resultado["registros"] =$registros;
        $resultado["totalregistros"] = $totalregistros;
        $resultado["numeropaginas"] = $numeropaginas;
        
        return  $resultado;

    }

    //crear datos
    public function insert($table, array $data)
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

    public function update($table, array $data, $where)
    {
        ksort($data);
        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "`$key`=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        $sth = $this->prepare("UPDATE {$table} SET $fieldDetails WHERE $where");
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        $stm = $sth->execute();
        return $stm;
    }
    //eliminar data
    public function delete($table, $where, $limit = 1)
    {
        $sth = $this->prepare("DELETE FROM {$table} WHERE $where LIMIT $limit");
        $stm = $sth->execute();
        return $stm;
    }


    //public function orderBy($column, $direction = 'asc'){}
    //public function orderByDesc($column){ }
    //public function where($column, $operator = null, $value = null, $boolean = 'and')
    //public function from($table, $as = null){}
    //public function delete($id = null){}
}
