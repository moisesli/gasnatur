<?php
use Config\Model;

Class CategoryProjectModel extends Model
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
            
            $sth = $this->db->insert('categoria_proyecto', $data);
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

    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM categoria_proyecto WHERE id = $id LIMIT 1";

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

            $sth = $this->db->update("categoria_proyecto", $data, "id={$id}");
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

			$sth = $this->db->delete("categoria_proyecto", "id={$id}");
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
				->select("c.id, t.descripcion AS TIPO_PROYECTO, c.descripcion AS DESCRIPCION")

				->table("categoria_proyecto c
					INNER JOIN tipo_proyecto t ON c.id_tipoproyecto=t.id")
			    ->where($filtro)
				->orderBy("c.id", "DESC")

				->paginator($pagina, $palabraBuscada);

			return $result;
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}