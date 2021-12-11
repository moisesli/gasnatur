<?php

use Config\Model;

class UserModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        $response = new \stdClass;
        $response->success = false;

        try {
            $sth = $this->db->insert('usuarios', $data);
            // validacion
            if ($sth) {
                $response->success = true;
                $response->message = "Registrado correctamente";
            } else {
                $response->message = "No se pudo registrar, vuelva a intentarlo";
            }
        } catch (\Exception $e) {
            $response->message = $e->getMessage();
        }
        return $response;
        //return true;
    }

    public function getAll()
    {

        try {
            return $this->db->findAll("select * from usuarios");
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function findById($id)
    {
        try {
            return $this->db->find("SELECT * FROM usuarios WHERE id={$id}");
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function findByComparatorRegister($comparator)
    {
        try {
            return $this->db->find("SELECT * FROM usuarios WHERE usuario='$comparator'");
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function update($data, $id)
    {
        $response = new \stdClass;
        $response->success = false;

        try {

            $sth = $this->db->update("usuarios", $data, "id={$id}");
            if (!$sth) {
                throw new \Exception("No pudimos actualizar el usuario");
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

            $sth = $this->db->delete("usuarios", "id={$id}");
            if (!$sth) {
                throw new \Exception("No pudimos eliminar la zona");
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
		$orderBy = 'usuario';
		try {
			if ($q != "") {
				$q = " usuario LIKE '%$q%' ";
			}
			return $this->db->paginator('usuarios', $pagina, $q, $orderBy);
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}

    
}
