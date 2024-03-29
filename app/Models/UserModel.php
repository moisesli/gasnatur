<?php

use Config\Model;
use Firebase\JWT\JWT;

class UserModel extends Model
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
            $data['clave'] = $this->db->encriptationInformationText($data['clave']);

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
            $sql = "SELECT * FROM usuarios WHERE usuario='$comparator'";
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

		$palabraBuscada = $q;
        $filtro = null;
        try {

            if ($q != "") {
                $filtro = " usuario LIKE '%$q%' ";
            }
			
			$result  = $this->db
				->select(" u.id, u.usuario, u.id_personal, p.nombres as nombres, 
                u.id_role, r.nombre AS rol")
				->table("usuarios u
                INNER JOIN personal p ON u.id_personal=p.id
                INNER JOIN roles r ON u.id_role = r.id")
			    ->where($filtro)
				->orderBy("u.id", "DESC")

				->paginator($pagina, $palabraBuscada);

			return $result;
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function login($usuario, $clave)
    {
        try {
            return $this->db->login($usuario, $clave);
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
