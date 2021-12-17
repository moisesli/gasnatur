<?php

use Config\Model;

class ProjectModel extends Model
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

			$sth = $this->db->insert("proyectos", $data);
			if (!$sth) {
				throw new \Exception("No pudimos registrar al personal");
			}

			$response->success = true;
			$response->message = "Registrado correctamente";
		} catch (\Exception $e) {
			$response->message = $e->getMessage();
		}

		return $response;
	}

    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM proyectos WHERE id = $id LIMIT 1";

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

			$sth = $this->db->update("proyectos", $data, "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos actualizar al personal");
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

			$sth = $this->db->delete("proyectos", "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos eliminar al personal");
			}

			$response->success = true;
			$response->message = "Eliminado correctamente";
		} catch (\Exception $e) {
			$response->message = $e->getMessage();
		}

		return $response;
	}

    public function findByComparatorRegister($comparator)
    {
        try {
			$sql = "SELECT * FROM proyectos WHERE nombre='$comparator'";
            return $this->db->find($sql);
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function paginator($pagina, $q)
    {
        $orderBy = 'id';
        $palabraBuscada = "";
        $filtro = "";
        try {
            if ($q != "") {
                $palabraBuscada = $q;
                $filtro = " nombre LIKE '%$q%' ";
            }
            return $this->db->paginator('proyectos', $pagina, $palabraBuscada, $filtro, $orderBy);
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

}