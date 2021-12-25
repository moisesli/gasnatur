<?php

use Config\Model;

class CommercialInformationModel extends Model
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
            
            $sth = $this->db->insert('informacion_comercial', $data);
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
    }

    public function findById($id)
	{
		try {
			$sql = "SELECT * FROM informacion_comercial WHERE id = $id LIMIT 1";

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

            $sth = $this->db->update("informacion_comercial", $data, "id={$id}");
            if (!$sth) {
                throw new \Exception("No pudimos actualizar");
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

			$sth = $this->db->delete("informacion_comercial", "id={$id}");
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
                $filtro = " consumo_prom_mensual LIKE '%$q%' ";
            }
			
			$result  = $this->db
				->select("i.id, c.numero AS NUMERO_CONTRATO, tp.descripcion AS TIPO_PROYECTO
                ,ct.nombre AS CATEGORIA_TARIFARIA, i.fecha_registro AS FECHA_REGISTRO
                ,i.volumen_contratado AS VOLUMEN_CONTRATADO, i.consumo_prom_mensual AS COMSUMO_PROMEDIO_MENSUAL
                ,i.condiciones_esp_acometida AS CONDICIONES_ACOMETIDA, i.observaciones AS OBSERVACIONES
                ,i.presion_minima AS PRESION_MINIMA, i.presion_maxima AS PRESION_MAXIMA")

				->table("informacion_comercial i
					INNER JOIN contratos c ON i.id_contrato=c.id
					INNER JOIN tipo_proyecto tp ON i.id_tipoproyecto=tp.id
                    INNER JOIN categoria_tarifaria ct ON id_categtarifaria=ct.id")
			    ->where($filtro)
				->orderBy("i.id", "DESC")

				->paginator($pagina, $palabraBuscada);

			return $result;
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }


}