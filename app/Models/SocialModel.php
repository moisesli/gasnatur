<?php

use Config\Model;

class SocialModel extends model
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

			$sth = $this->db->insert("estrato_social", $data);
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

	public function getAll()
	{
		try {
			return $this->db->findAll("SELECT * FROM estrato_social");
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}

	public function findByComparatorRegister($comparator)
	{
		try {
			$sql = "SELECT * FROM estrato_social WHERE nombre='$comparator'";
			return $this->db->find($sql);
		} catch (\Exception $e) {

			return ["success" => false, "message" => $e->getMessage()];
		}
	}

	public function findById($id)
	{
		try {
			$sql = "SELECT * FROM estrato_social WHERE id = $id LIMIT 1";

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

			$sth = $this->db->update("estrato_social", $data, "id={$id}");
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

			$sth = $this->db->delete("estrato_social", "id={$id}");
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
				->select("*")

				->table("estrato_social e")
			    ->where($filtro)
				->orderBy("e.id", "DESC")

				->paginator($pagina, $palabraBuscada);

			return $result;
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
