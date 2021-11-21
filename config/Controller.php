<?php

namespace Config;

class Controller extends Routeparams
{

//    public function view($view)
//    {
//
//        require './views/layout/header.php';
//        include './views/'.$view.'.php';
//        require './views/layout/footer.php';
//
//    }

  public function view($view, $data = [])
  {
    return $this->view->show($view, $data);
  }


}