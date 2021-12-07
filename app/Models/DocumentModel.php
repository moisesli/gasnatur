<?php

use Config\Model;

class DocumentModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
	{
		$response = new \stdClass;
		$response->success = false;

		try {

			$sth = $this->db->insert("identities_documents", $data);
			if(!$sth){
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

			return $this->db->findAll("SELECT * FROM identities_documents");

		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}

    public function update($data, $id)
    {
        $response = new \stdClass;
        $response->success = false;

        try {

            $sth = $this->db->update("identities_documents", $data, "id={$id}");
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

    public function delete($id){
		$response = new \stdClass;
		$response->success = false;

		try {

			$sth = $this->db->delete("identities_documents", "id={$id}");
			if(!$sth){
				throw new \Exception("No pudimos eliminar la zona");
			}

			$response->success = true;
			$response->message = "Eliminado correctamente";
			
		} catch (\Exception $e) {
			$response->message = $e->getMessage();
		}

		return $response;
	}
}
