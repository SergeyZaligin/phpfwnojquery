<?php

namespace app\controllers;

use app\models\Product;
use app\models\Category;
use engine\libs\Pagination;
use engine\base\View;
use engine\App;
use engine\libs\Breadcrumbs;

/**
 * Description of MainController
 *
 * @author Sergey
 */
class MainController extends AppController
{

    public function indexAction() 
    {
        View::setMeta('Индекс пейдж', "Это описание индекс пейдж", "Это кейвордс");
        
    }
    
}
