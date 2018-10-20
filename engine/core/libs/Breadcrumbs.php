<?php

namespace engine\libs;

/**
 * Description of Breadcrumbs
 *
 * @author sergey
 */
class Breadcrumbs 
{
    public $id;
    public $productId;
    public $data = [];
    public $breadcrumbsData;
    public $breadcrumbs = "<a href='/'>Главная</a>";

    public function __construct($array, $id, $itemId = 0, $itemTitle = '') 
    {
        $this->breadcrumbsData = $this->buildBreadcrumbs($array, $id);
        
        if ($this->breadcrumbsData) {
            foreach ($this->breadcrumbsData as $id => $title) {
                $this->breadcrumbs .= " / <a href='/category/{$id}' title='{$title}' >{$title}</a>";
            }
            if (!$itemId){
                $this->breadcrumbs = preg_replace("#(.+)?<a.+>(.+)</a>$#", "$1$2", $this->breadcrumbs);
            } else {
                $this->breadcrumbs .= " / $itemTitle"; 
            }
            
        } else {
            $this->breadcrumbs = "<a href='/'>На главную</a>";
        }
    }
    
    public function buildBreadcrumbs($array, $id) 
    {
        
        if(!$id){
            return false;
        }
        
        $count = count($array);
        $br_arr = [];
        
        for ($i = 0; $i < $count; $i++) {
            if (isset($array[$id])) {
                $br_arr[$array[$id]['id']] = $array[$id]['title'];
                $id = $array[$id]['parent'];
            } else {
                break;
            }
        }
        return array_reverse($br_arr, true);
    }
    
}
