<?php
use Config\Model;

Class NationalityModel extends Model
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
            
            $sth = $this->db->insert('nacionalidades', $data);
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

    public function findByComparatorRegister($comparator)
    {
        try {
            $sql = "SELECT * FROM nacionalidades WHERE descripcion='$comparator'";
            return $this->db->find($sql);
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM nacionalidades WHERE id = $id LIMIT 1";

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

            $sth = $this->db->update("nacionalidades", $data, "id={$id}");
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

			$sth = $this->db->delete("nacionalidades", "id={$id}");
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

		$palabraBuscada = $q;
        $filtro = null;
        try {

            if ($q != "") {
                $filtro = " descripcion LIKE '%$q%' ";
            }
			
			$result  = $this->db
				->select("*")

				->table("nacionalidades n")
			    ->where($filtro)
				->orderBy("n.id", "DESC")

				->paginator($pagina, $palabraBuscada);

			return $result;
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}