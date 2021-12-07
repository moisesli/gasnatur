<?php

use Config\Model;

class ChargeModel extends Model
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
            $sth = $this->db->insert('charges', $data);
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
            return $this->db->findAll("select * from charges");
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }

    }

    public function update($data, $id)
    {
        $response = new \stdClass;
        $response->success = false;

        try {

            $sth = $this->db->update("charges", $data, "id={$id}");
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

        $result = $this->db->delete('charges', 'id' . '=' . $id);
        return;
    }
}
