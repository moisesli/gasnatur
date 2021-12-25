<?php

use Config\Model;

class AppleModel extends model
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

			$sth = $this->db->insert("manzanas", $data);
			if (!$sth) {
				throw new \Exception("No pudimos registrar");
			}

			$response->success = true;
			$response->message = "Registrado correctamente";
		} catch (\Exception $e) {
			$response->message = $e->getMessage();
		}

		return $response;
	}

    public function findByComparatorRegister($comparator)
	{
		try {
			$sql = "SELECT * FROM manzanas WHERE numero='$comparator'";
			return $this->db->find($sql);
		} catch (\Exception $e) {

			return ["success" => false, "message" => $e->getMessage()];
		}
	}

    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM manzanas WHERE id = $id LIMIT 1";

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

			$sth = $this->db->update("manzanas", $data, "id={$id}");
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

			$sth = $this->db->delete("manzanas", "id={$id}");
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
                $filtro = " nombre LIKE '%$q%' ";
            }
			
			$result  = $this->db
				->select("m.id, e.nombre AS ESTRATO_SOCIAL
					,ma.nombre AS MALLA, m.nombre AS NOMBRE, m.numero AS NUMERO")

				->table("manzanas m
					INNER JOIN estrato_social e ON m.id_estrato=e.id
					INNER JOIN mallas ma ON m.id=ma.id")
			    ->where($filtro)
				->orderBy("m.id", "DESC")

				->paginator($pagina, $palabraBuscada);

			return $result;
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}