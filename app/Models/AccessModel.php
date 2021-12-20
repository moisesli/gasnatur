<?php

use Config\Model;

class AccessModel extends model
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

    public function findByIdRole($idRole)
	{
		try {
			$sql = "SELECT * FROM permisos WHERE id_role = $idRole";

			return $this->db->findAll($sql);
		} catch (\Exception $e) {

			return ["success" => false, "message" => $e->getMessage()];
		}
	}
}