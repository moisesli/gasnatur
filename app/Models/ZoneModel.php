<?php

use Config\Model;

class ZoneModel extends Model
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

			$sth = $this->db->insert("zonas", $data);
			if (!$sth) {
				throw new \Exception("No pudimos registrar la zona");
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
			return $this->db->findAll("SELECT * FROM zonas");
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}

	public function findByComparatorRegister($comparator)
	{
		try {
			return $this->db->find("SELECT * FROM zonas WHERE nombre='$comparator'");
		} catch (\Exception $e) {

			return ["success" => false, "message" => $e->getMessage()];
		}
	}

	public function findById($id)
	{
		try {
			$sql = "SELECT * FROM zonas WHERE id = $id LIMIT 1";

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

			$sth = $this->db->update("zonas", $data, "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos actualizar la zona");
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

			$sth = $this->db->delete("zonas", "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos eliminar la zona");
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
			return $this->db->paginator('zonas', $pagina, $palabraBuscada, $filtro, $orderBy);
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}
}
