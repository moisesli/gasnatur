<?php

use Config\Model;

class MeshModel extends Model
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
            $sth = $this->db->insert('mallas', $data);
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
            $sql = "SELECT * FROM mallas WHERE nombre='$comparator'";
            return $this->db->find($sql);
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM mallas WHERE id = $id LIMIT 1";
			
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

            $sth = $this->db->update("mallas", $data, "id={$id}");
            if (!$sth) {
                throw new \Exception("No pudimos actualizar el cargo");
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

			$sth = $this->db->delete("mallas", "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos eliminar el cargo");
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
				$filtro = " nombre LIKE '%$q%' ";
			}
			return $this->db->paginator('mallas', $pagina, $palabraBuscada ,$filtro, $orderBy);
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}
}