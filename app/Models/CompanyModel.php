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

			$sth = $this->db->insert("empresas", $data);
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
			$sql = "SELECT * FROM empresas WHERE id = $id LIMIT 1";

			return $this->db->find($sql);
		} catch (\Exception $e) {

			return ["success" => false, "message" => $e->getMessage()];
		}
	}

	public function findByComparatorRegister($comparator1, $comparator2)
	{
		try {
			$sql = "SELECT * FROM empresas WHERE nombre_comercial='$comparator1' OR ruc='$comparator2' ";
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

			$sth = $this->db->update("empresas", $data, "id={$id}");
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

			$sth = $this->db->delete("empresas", "id={$id}");
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

		$palabraBuscada = $q;
        $filtro = null;
        try {

            if ($q != "") {
                $filtro = " ruc LIKE '%$q%' ";
            }
			
			$result  = $this->db
				->select("e.id, d.descripcion AS DISTRITO, e.ruc, e.razon_social,
				e.nombre_comercial AS NOMBRE, e.direccion AS DIRECCION, e.anexo AS ANEXO,
				e.telefono AS TELEFONO, e.celular AS CELULAR, e.correo AS CORREO, e.web AS WEB ,e.estado AS ESTADO")

				->table("empresas e
					INNER JOIN distritos d ON e.id_ubigeo=d.id")
			    ->where($filtro)
				->orderBy("e.id", "DESC")

				->paginator($pagina, $palabraBuscada);

			return $result;
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }


    // public function paginator($pagina, $q)
	// {
	// 	$orderBy = 'id';
	// 	$palabraBuscada = "";
	// 	$filtro = "";

	// 	try {
	// 		if ($q != "") {
				
	// 			$palabraBuscada = $q;

	// 			if(is_numeric($q)){
	// 			$filtro = " ruc LIKE '%$q%'";
	// 			}else{
	// 			$filtro = " nombre_comercial LIKE '%$q%' OR razon_social LIKE '%$q%'" ;
	// 			}

	// 		}
	// 		return $this->db->paginator('empresas', $pagina, $palabraBuscada, $filtro, $orderBy);
	// 	} catch (\Exception $e) {
	// 		return ["success" => false, "message" => $e->getMessage()];
	// 	}
	// }
}