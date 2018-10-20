<?php

namespace app\models;


/**
 * Description of Product
 *
 * @author Sergey
 */
class Product extends AppModel
{
    
    /**
     * Get one product by id
     * 
     * @param int $id
     * @return array
     */
    public function getOneById(int $id)
    {
        return $this->db->query("SELECT * FROM `products` WHERE id=:id LIMIT 1", [
            'id' => $id,
            ], \PDO::FETCH_CLASS)[0];
    }
    
    public function get() 
    {
        return $this->db->query("SELECT id, title, parent FROM categories", [], \PDO::FETCH_ASSOC);
    }
    
    public function getAllByIdsForPag($ids, $start, $perPage) 
    {
        if ($ids) {
            return $this->db->query("SELECT * FROM products WHERE parent IN($ids) LIMIT :start, :perPage", [
                'start' => $start,
                'perPage' => $perPage
                    ], \PDO::FETCH_CLASS);
        } else {
            return $this->db->query("SELECT * FROM products LIMIT :start, :perPage", [
                'start' => $start,
                'perPage' => $perPage
            ], \PDO::FETCH_CLASS);
        }
        
    }
    
    public function getAllByIds($ids) 
    {
        if ($ids) {
            return $this->db->query("SELECT * FROM products WHERE parent IN($ids)", [
                
                    ], \PDO::FETCH_CLASS);
        } else {
            return $this->db->query("SELECT * FROM products", [
               
            ], \PDO::FETCH_CLASS);
        }
        
    }
    
    public function getAll($start, $perPage) 
    {
        return $this->db->query("SELECT * FROM products LIMIT :start, :perPage", [
            'start' => $start,
            'perPage' => $perPage
        ], \PDO::FETCH_CLASS);
    }
    
    public function getAllByCategoryId($start, $perPage, $id) 
    {
        return $this->db->query("SELECT * FROM products WHERE parent = :id LIMIT :start, :perPage", [
            'start' => $start,
            'perPage' => $perPage,
            'id' => $id
        ], \PDO::FETCH_CLASS);
    }
    
    /**
     * Get count items
     * 
     * @param array $arr
     * @return int
     */
    public function count(array $arr): int
    {
        return (int) count((array)$arr);
    }
    
    /**
     * Get products by id
     * 
     * @param int $id
     */
    public function getCommentsById(int $id) 
    {
        $arr = $this->db->query("SELECT * FROM `comments` WHERE comment_product=:id", [
                'id' => $id,
                ], \PDO::FETCH_ASSOC);
        $data = [];
        foreach ($arr as $value) {
            $data[$value['comment_id']] = $value;
        }
        return $data;
    }
    
}

