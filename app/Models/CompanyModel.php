<?php

use Config\Model;

class CompanyModel extends Model
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

			$sth = $this->db->insert("empresa", $data);
			if (!$sth) {
				throw new \Exception("No pudimos registrar la empresa");
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
			$sql = "SELECT * FROM empresa WHERE id = $id LIMIT 1";

			return $this->db->find($sql);
		} catch (\Exception $e) {

			return ["success" => false, "message" => $e->getMessage()];
		}
	}

	public function findByComparatorRegister($comparator1, $comparator2)
	{
		try {
			$sql = "SELECT * FROM empresa WHERE nombre_comercial='$comparator1' OR ruc='$comparator2' ";
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

			$sth = $this->db->update("empresa", $data, "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos actualizar la empresa");
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

			$sth = $this->db->delete("empresa", "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos eliminar la empresa");
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
				$filtro = " ruc LIKE '%$q%' ";
			}
			return $this->db->paginator('empresa', $pagina, $palabraBuscada, $filtro, $orderBy);
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}
}