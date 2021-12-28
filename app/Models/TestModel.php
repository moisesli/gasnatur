<?php

namespace App\Models;
use Config\Model;

class TestModel extends Model
{

    public function getAll(){
        return $this->setPaginator();
    }

}
