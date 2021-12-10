<?php

use Config\Model;

class ChargeModel extends Model
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
            $sth = $this->db->insert('cargos', $data);
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
            return $this->db->findAll("SELECT * from cargos");
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function findByComparatorRegister($comparator)
    {
        try {
            return $this->db->find("SELECT * FROM cargos WHERE nombre='$comparator'");
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }


    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM cargos WHERE id = $id LIMIT 1";
			
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

            $sth = $this->db->update("cargos", $data, "id={$id}");
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

			$sth = $this->db->delete("cargos", "id={$id}");
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

    // public function delete($id)
    // {

    //     $result = $this->db->delete('charges', 'id' . '=' . $id);
    //     return;
    // }
}
