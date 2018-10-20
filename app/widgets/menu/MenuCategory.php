<?php

namespace app\widgets\menu;

use engine\Cache;
use app\widgets\menu\model\Menu;

class MenuCategory
{
    /**
     * Data
     * 
     * @var array
     */
    protected $data;
    /**
     * Build tree
     * 
     * @var array
     */
    protected $tree;
    /**
     * Render menu html
     * 
     * @var string
     */
    protected $menuHtml;
    /**
     * Path template
     * 
     * @var string
     */
    protected $tpl;
    /**
     * Container tag menu
     * 
     * @var string
     */
    protected $container = 'ul';
    /**
     * Attribute class tag menu
     * 
     * @var string
     */
    protected $class = 'menu';
    /**
     * Table name
     * 
     * @var string
     */
    protected $table = 'categories';
    /**
     * Time on cache
     * 
     * @var int
     */
    protected $cache = 3600;
    /**
     * Cache name
     * 
     * @var string
     */
    protected $cacheKey = 'fw_menu';

    /**
     * Constructor menu
     * 
     * @param type $options
     */
    public function __construct($options = []){
        $this->tpl = WIDGETS . '/menu/menu_tpl/menu.php';
        //$this->getOptions($options);
        $this->run();
    }

    /**
     * Options
     * 
     * @param type $options
     */
    protected function getOptions($options){
        foreach($options as $k => $v){
            if(property_exists($this, $k)){
                $this->$k = $v;
            }
        }
    }

//    protected function output(){
//        echo "<{$this->container} class='{$this->class}'>";
//            echo $this->menuHtml;
//        echo "</{$this->container}>";
//    }

    /**
     * Run widget menu
     */
    protected function run(){
        
      
        
            $menuModel = new Menu();
            
            $this->data = $menuModel->getAll($this->table);
            
            foreach ($this->data as $value) {
                $data[$value['id']] = $value;
            }
            
            $this->data = $data;
            
            $this->tree = $this->getTree();
            //debug($this->data);
            //die;
            $this->menuHtml = $this->getMenuHtml($this->tree);
            
     
        echo $this->menuHtml;
    }
    /**
     * Build tree
     * 
     * @return array
     */
    protected function getTree(){
        $tree = [];
        $data = $this->data;
        foreach ($data as $id=>&$node) {
            if (!$node['parent']){
                $tree[$id] = &$node;
            }else{
                $data[$node['parent']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }
    
    /**
     * Get menu Html
     * 
     * @param type $tree
     * @param type $tab
     * @return type
     */
    protected function getMenuHtml($tree, $tab = ''){
        $str = '';
        foreach($tree as $id => $category){
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }
    
    /**
     * Categories to template 
     * 
     * @param type $category
     * @param type $tab
     * @param type $id
     * @return type
     */
    protected function catToTemplate($category, $tab, $id){
        ob_start();
        include WIDGETS . '/menu/menu_tpl/menu.php';
        return ob_get_clean();
    }

}