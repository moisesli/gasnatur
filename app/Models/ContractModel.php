<?php

use Config\Model;

class ContractModel extends model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        unset($data['id']);
        $response = new \stdClass;
        $response->success = false;

        try {

            $sth = $this->db->insert("contratos", $data);
            if (!$sth) {
                throw new \Exception("No pudimos registrar");
            }

            $response->success = true;
            $response->message = "Registrado correctamente";
        } catch (\Exception $e) {
            $response->message = $e->getMessage();
        }

        return $response;
    }

    public function findByComparatorRegister($comparator)
    {
        try {
            $sql = "SELECT * FROM contratos WHERE numero='$comparator'";
            return $this->db->find($sql);
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function findById($id)
    {
        try {
            $sql = "SELECT * FROM contratos WHERE id = $id LIMIT 1";

            return $this->db->find($sql);
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function update($data, $id)
    {
        $response = new \stdClass;
        $response->success = false;

        try {

            $sth = $this->db->update("contratos", $data, "id={$id}");
            if (!$sth) {
                throw new \Exception("No pudimos actualizar");
            }

            $response->success = true;
            $response->message = "Actualizado correctamente";
        } catch (\Exception $e) {
            $response->message = $e->getMessage();
        }

        return $response;
    }

    public function delete($id)
    {
        $response = new \stdClass;
        $response->success = false;

        try {

            $sth = $this->db->delete("contratos", "id={$id}");
            if (!$sth) {
                throw new \Exception("No pudimos eliminar");
            }

            $response->success = true;
            $response->message = "Eliminado correctamente";
        } catch (\Exception $e) {
            $response->message = $e->getMessage();
        }

        return $response;
    }

    public function paginator($pagina, $q)
    {
        $orderBy = 'id';
        $palabraBuscada = "";
        $filtro = "";

        try {
            if ($q != "") {
                $palabraBuscada = $q;
                $filtro = " etapa LIKE '%$q%' ";
            }
            return $this->db->paginator('contratos', $pagina, $palabraBuscada, $filtro, $orderBy);
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
