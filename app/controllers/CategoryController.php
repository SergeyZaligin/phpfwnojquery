<?php

namespace app\controllers;

use app\models\Product;
use app\models\Category;
use engine\libs\Pagination;
use engine\base\View;
use engine\App;
use engine\libs\Breadcrumbs;


/**
 * Description of CategoryController
 *
 * @author Sergey
 */
class CategoryController extends AppController
{

    public function indexAction() 
    {
        View::setMeta('Индекс пейдж', "Это описание индекс пейдж", "Это кейвордс");
        $modelProduct = new Product();
        $modelCategory = new Category();
        
        if (isset($this->route['id'])) {
            $id = (int)$this->route['id'];
        } else {
            $id = 0;
        }
        
        $breadcrumbsArr = $modelCategory->getAllKeysById();
        $ids = $modelCategory->categoryIds($breadcrumbsArr, $id);
        $ids = !$ids ? $id : rtrim($ids, ',');
        $breadcrumbs = new Breadcrumbs($breadcrumbsArr, $id);
        
        
        $products = $modelProduct->getAllByIds($ids);
        
        $total = $modelProduct->count($products);
        
        //debug($total);
        
        $page = isset(App::$app->request->get['page']) ? (int) App::$app->request->get['page'] : 1;
        $perPage = 10;
        $pagination = new Pagination($page, $perPage, $total);
        
        $start = $pagination->getStart();
        
        $products = $modelProduct->getAllByIdsForPag($ids, $start, $perPage);
        
       
        $this->setData(compact('products', 'pagination', 'breadcrumbs'));
    }

}
