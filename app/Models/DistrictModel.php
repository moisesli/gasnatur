<?php

use Config\Model;

class DistrictModel extends Model
{
    public function __construct()
	{
		parent::__construct();
	}

	public function create($data)
    {
        //unset($data['id']);
        $response = new \stdClass;
        $response->success = false;

        try {
            $sth = $this->db->insert('distritos', $data);
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

	public function findByComparatorRegister($comparator)
    {
        try {
            $sql = "SELECT * FROM distritos WHERE descripcion='$comparator'";
            return $this->db->find($sql);
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function getAll()
	{
		try {
			return $this->db->findAll("SELECT * FROM distritos");
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}

	public function findById($id)
	{
		try {
			$sql = "SELECT * FROM distritos WHERE id = $id LIMIT 1";
			
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

            $sth = $this->db->update("distritos", $data, "id={$id}");
            if (!$sth) {
                throw new \Exception("No pudimos actualizar el distrito");
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

			$sth = $this->db->delete("distritos", "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos eliminar el distrito");
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
				$filtro = " descripcion LIKE '%$q%' ";
			}
			return $this->db->paginator('distritos', $pagina, $palabraBuscada, $filtro, $orderBy);
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}
}