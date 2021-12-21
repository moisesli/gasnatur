<?php

use Config\Model;

class TypeDocModel extends Model
{
    public function __construct()
	{
		parent::__construct();
	}

    public function getAll()
	{
		try {
			return $this->db->findAll("SELECT * FROM tipo_documentos_identidad");
		} catch (\Exception $e) {
			return ["success" => false, "message" => $e->getMessage()];
		}
	}
}