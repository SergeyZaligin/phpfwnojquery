<?php

namespace app\controllers\admin;

use engine\base\View;

/**
 * Description of UserController
 *
 * @author Sergey
 */
class UserController extends AdminController
{

    public function indexAction() 
    {
        View::setMeta("Админка", "Панель администратора сайта", "админка");
    }
    
    public function testAction() 
    {
        echo __METHOD__;
    }   
}
