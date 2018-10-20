<?php

namespace app\widgets\menu\model;

use app\models\AppModel;
/**
 * Description of Menu
 *
 * @author Sergey
 */
class Menu extends AppModel
{
    /**
     * GEt all category
     * 
     * @param type $table
     * @return type
     */
    public function getAll($table) 
    {
        return $this->db->query("SELECT * FROM {$table}",[]);
    }

}
