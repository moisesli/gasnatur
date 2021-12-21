<?php

use Config\Model;

class PersonalModel extends Model
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

			$sth = $this->db->insert("personal", $data);
			if (!$sth) {
				throw new \Exception("No pudimos registrar al personal");
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
			return $this->db->findAll("SELECT * FROM personal");
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}

    public function findByComparatorRegister($comparator)
    {
        try {
			$sql = "SELECT * FROM personal WHERE numero='$comparator'";
            return $this->db->find($sql);
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM personal WHERE id = $id LIMIT 1";

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

			$sth = $this->db->update("personal", $data, "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos actualizar al personal");
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

			$sth = $this->db->delete("personal", "id={$id}");
			if (!$sth) {
				throw new \Exception("No pudimos eliminar al personal");
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
                $filtro = " apellidos LIKE '%$q%' ";
            }
			$sql = "personal 
			INNER JOIN cargos ON personal.id_cargo=cargos.id
			INNER JOIN tipo_documentos_identidad ON personal.id_tipodoc = tipo_documentos_identidad.id";

			$camposADevolver=" personal.id, personal.nombres, personal.id_cargo, cargos.nombre
			,personal.id_tipodoc, tipo_documentos_identidad.descripcion as documento";

        	return $this->db->paginator($sql, $pagina, $palabraBuscada, $filtro, $orderBy,[],$camposADevolver = $camposADevolver);
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }


	
}
