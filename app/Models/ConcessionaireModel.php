<?php
use Config\Model;

class ConcessionaireModel extends Model{

    public function __contruct(){
        parent::__construct();
    }

    public function create($data)
    {
        unset($data['id']);
        $response = new \stdClass;
        $response->success = false;

        try {
            $sth = $this->db->insert('concesionarias', $data);
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
    }

    public function getAll()
	{
		try {
			return $this->db->findAll("SELECT * FROM concesionarias");
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}

    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM concesionarias WHERE id = $id LIMIT 1";
			return $this->db->find($sql);
		} catch (\Exception $e) {

			return ["success" => false, "message" => $e->getMessage()];
		}
	}

    public function findByComparatorRegister($comparator)
    {
        try {
            $sql = "SELECT * FROM concesionarias WHERE descripcion='$comparator'";
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

            $sth = $this->db->update("concesionarias", $data, "id={$id}");
            if (!$sth) {
                throw new \Exception("No pudimos actualizar la concesionaria");
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

			$sth = $this->db->delete("concesionarias", "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos eliminar la concesionaria");
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
			return $this->db->paginator('concesionarias', $pagina, $palabraBuscada ,$filtro, $orderBy);
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}

}