<?php

use Config\Model;

class FinancingModel extends model
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

			$sth = $this->db->insert("planes_financiamiento", $data);
			if (!$sth) {
				throw new \Exception("No se pudo registrar, vuelva a intentarlo");
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
			return $this->db->findAll("SELECT * FROM planes_financiamiento");
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}

    public function findByComparatorRegister($comparator)
	{
		try {
			$sql = "SELECT * FROM planes_financiamiento WHERE descripcion='$comparator'";
			return $this->db->find($sql);
		} catch (\Exception $e) {

			return ["success" => false, "message" => $e->getMessage()];
		}
	}

    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM planes_financiamiento WHERE id = $id LIMIT 1";

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

			$sth = $this->db->update("planes_financiamiento", $data, "id={$id}");
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

			$sth = $this->db->delete("planes_financiamiento", "id={$id}");
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
                $filtro = " descripcion LIKE '%$q%' ";
            }
			
			$result  = $this->db
				->select("*")

				->table("planes_financiamiento p")
			    ->where($filtro)
				->orderBy("p.id", "DESC")

				->paginator($pagina, $palabraBuscada);

			return $result;
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }	

}
