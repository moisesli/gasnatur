<?php

use Config\Model;

class ProjectModel extends Model
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

			$sth = $this->db->insert("proyectos", $data);
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

    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM proyectos WHERE id = $id LIMIT 1";

			return $this->db->find($sql);
		} catch (\Exception $e) {

			return ["success" => false, "message" => $e->getMessage()];
		}
	}

	public function getInnerJoin()
	{
		try {
			$sql = "SELECT proyectos.id, proyectos.nombre, empresas.nombre_comercial as empresa, 
			concesionarias.descripcion AS concesionaria,
			proyectos.fecha_inicio, proyectos.numero_inicial
			FROM proyectos 
			INNER JOIN empresas ON proyectos.id_empresa=empresas.id
			INNER JOIN concesionarias ON proyectos.id_concesionaria = concesionarias.id WHERE";
			return $this->db->findAll($sql);
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}

    public function update($data, $id)
	{
		$response = new \stdClass;
		$response->success = false;

		try {

			$sth = $this->db->update("proyectos", $data, "id={$id}");
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

			$sth = $this->db->delete("proyectos", "id={$id}");
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

    public function findByComparatorRegister($comparator)
    {
        try {
			$sql = "SELECT * FROM proyectos WHERE nombre='$comparator'";
            return $this->db->find($sql);
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function paginator($pagina, $q)
    {
        $orderBy = 'proyectos.id';
        $palabraBuscada = "";
        $filtro = "";
        try {
            if ($q != "") {
                $palabraBuscada = $q;
                $filtro = " nombre LIKE '%$q%' ";
            }

			$sql = "proyectos 
			INNER JOIN empresas ON proyectos.id_empresa=empresas.id
			INNER JOIN concesionarias ON proyectos.id_concesionaria = concesionarias.id";

			$camposADevolver=" proyectos.id, proyectos.nombre
			,proyectos.id_empresa, empresas.nombre_comercial as empresa 
			,proyectos.id_concesionaria,concesionarias.descripcion AS concesionaria,
			proyectos.fecha_inicio, proyectos.numero_inicial";

        	return $this->db->paginator($sql, $pagina, $palabraBuscada, $filtro, $orderBy,[],$camposADevolver = $camposADevolver);
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

}