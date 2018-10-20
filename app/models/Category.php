<?php

namespace app\models;

/**
 * Description of Category
 *
 * @author sergey
 */
class Category extends AppModel
{
    /**
     * Get assoc array where key by id
     * 
     * @return aray
     */
    public function getAllKeysById(): array
    {
        $cat =  $this->db->query("SELECT id, title, parent FROM categories", [], \PDO::FETCH_ASSOC);
        $data = [];
        
        foreach ($cat as $value) {
            $data[$value['id']] = $value;
        }
        
        return $data;
    }
    
    /**
     * Get all ids for category
     * 
     * @param array $array
     * @param int $id
     * @return string
     */
    public function categoryIds(array $array, int $id): string
    {
        if (!$id) {
            return false;
        }
        
        $data = '';
        
        foreach ($array as $item) {
            if ($item['parent'] === (int)$id) {
                $data .= $item['id'] . ',';
                $data .= $this->categoryIds($array, $item['id']);
            }
        }
        
        return (string)$data;
    }
}
