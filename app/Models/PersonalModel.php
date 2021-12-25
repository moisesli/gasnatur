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

		$palabraBuscada = $q;
        $filtro = null;
        try {

            if ($q != "") {
                $filtro = " numero LIKE '%$q%' ";
            }
			
			$result  = $this->db
				->select("p.id, p.nombres, p.id_cargo, c.nombre
				,p.id_tipodoc, t.descripcion as documento")

				->table("personal p
				INNER JOIN cargos c ON p.id_cargo = c.id
				INNER JOIN tipo_documentos_identidad t ON p.id_tipodoc = t.id")
			    ->where($filtro)
				->orderBy("p.id", "DESC")

				->paginator($pagina, $palabraBuscada);

			return $result;
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }	
}
