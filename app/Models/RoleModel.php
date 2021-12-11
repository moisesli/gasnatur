<?php
use Config\Model;

Class RoleModel extends Model
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
            $sth = $this->db->insert('roles', $data);
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
    }

    public function getAll()
    {

        try {
            return $this->db->findAll("SELECT * FROM roles");
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }

    }

    public function findByComparatorRegister($comparator)
    {
        try {
            return $this->db->find("SELECT * FROM roles WHERE nombre='$comparator'");
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM roles WHERE id = $id LIMIT 1";

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

            $sth = $this->db->update("roles", $data, "id={$id}");
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

			$sth = $this->db->delete("roles", "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos eliminar el rol");
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
		$orderBy = 'nombre';
		try {
			if ($q != "") {
				$q = " nombre LIKE '%$q%' ";
			}
			return $this->db->paginator('roles', $pagina, $q, $orderBy);
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}
}
