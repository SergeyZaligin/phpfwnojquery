<?php

namespace app\controllers\admin;

use engine\base\Controller; 
use app\models\AppModel;

/**
 * Description of AdminController
 *
 * @author Sergey
 */
abstract class AdminController extends Controller 
{
    public $layout = 'admin';
    private $isAdmin = false;
    
    public function __construct($route) 
    {
        parent::__construct($route);
        new AppModel();
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            $this->isAdmin = true;
        } 
        if (!$this->isAdmin) {
            redirect('/');
        }
    }

}
