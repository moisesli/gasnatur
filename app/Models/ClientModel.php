<?php

use Config\Model;

class ClientModel extends Model
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
            $sth = $this->db->insert('clientes', $data);

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

    public function findById($id)
    {
        try {
            return $this->db->find("SELECT * FROM clientes WHERE id={$id}");
        } catch (\Exception $e) {

            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    public function findByComparatorRegister($comparator)
    {
        try {
            $sql = "SELECT * FROM clientes WHERE numero='$comparator'";
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

            $sth = $this->db->update("clientes", $data, "id={$id}");
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
        $response = new \stdClass;
        $response->success = false;

        try {

            $sth = $this->db->delete("clientes", "id={$id}");
            if (!$sth) {
                throw new \Exception("No pudimos eliminar");
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
                $filtro = " nombres LIKE '%$q%' ";
            }
			
			$result  = $this->db
				->select("c.id, t.descripcion AS DOCUMENTO_IDENTIDAD
					,n.descripcion AS NACIONALIDAD, c.fecha_registro AS REGISTRO
                    ,c.numero AS NUMERO, c.nombres AS NOMBRES, c.fecha_nacimiento AS FECHA_NACIMIENTO
                    ,c.estado_civil AS ESTADO_CIVIL, c.direccion  AS DIRECCION, c.telefono AS TELEFONO
                    ,c.celular AS CELULAR, c.correo AS CORREO, c.recibo_digital AS RECIBO_DIGITAL
                    ,c.estado AS ESTADO")

				->table("clientes c
					INNER JOIN tipo_documentos_identidad t ON c.id_tipodoc=t.id
					INNER JOIN nacionalidades n ON c.id_nacionalidad=n.id")
			    ->where($filtro)
				->orderBy("c.id", "DESC")

				->paginator($pagina, $palabraBuscada);

			return $result;
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }

    // public function paginator($pagina, $q)
    // {
    //     $orderBy = 'id';
    //     $palabraBuscada = "";
    //     $filtro = "";
    //     try {
    //         if ($q != "") {
    //             $palabraBuscada = $q;
    //             $filtro = " numero LIKE '%$q%' ";
    //         }
    //         return $this->db->paginator('clientes', $pagina, $palabraBuscada, $filtro, $orderBy);
    //     } catch (\Exception $e) {
    //         return ["success" => false, "message" => $e->getMessage()];
    //     }
    // }

}