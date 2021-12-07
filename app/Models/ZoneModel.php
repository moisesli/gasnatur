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
        $response = new \stdClass;
        $response->success = false;

        try {
            $sth = $this->db->insert('zones', $data);
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
        $result = $this->db->findAll("select * from zones");
        return $result;
    }

	public function update($data, $id)
    {
        $response = new \stdClass;
        $response->success = false;

        try {

            $sth = $this->db->update("zones", $data, "id={$id}");
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

        $result = $this->db->delete('zones', 'id' . '=' . $id);
        return;
    }
}
