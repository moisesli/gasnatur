<?php

//namespace App\Models;

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
            $sth = $this->db->insert('identities_documents', $data);
            // validacion
            if ($sth) {
                $response->success = true;
                $response->message = "Registrado correctamente";
            } else {
                $response->message = "No se pudo registrar, vuelva a intentarlo";
            }
        } catch (\Exception $e) {
            $response->message = $e->getMessage();
        }
        return $response;
        //return true;
    }

    public function getAll()
    {

        try {
            return $this->db->findAll("select * from identities_documents");
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
                throw new \Exception("No pudimos actualizar el usuario");
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

        $result = $this->db->delete('identities_documents', 'id' . '=' . $id);
        return;
    }
}
