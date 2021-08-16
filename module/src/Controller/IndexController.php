<?php

namespace Fayouz\Laminas\Mailer\Core\Controller;

class IndexController extends \Laminas\Mvc\Controller\AbstractActionController
{
    public function indexAction(){
        
        var_dump('coucou');
        var_dump($_POST);
        die();
    }
}
