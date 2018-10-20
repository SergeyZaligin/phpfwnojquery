<?php

namespace app\models;

use engine\App;

/**
 * Description of User
 *
 * @author Sergey
 */
class Comment extends AppModel {

    /**
     * Attributes model user
     * 
     * @var array
     */
    public $attributes = [
        'comment_author' => '',
        'comment_text' => '',
        'parent' => '',
        'productId' => ''
    ];
    
    public $lastCommentId;
    /**
     * Rules validation
     * 
     * @var array
     */
    public $rules = [
        'required' => [
            'comment_author',
            'comment_text'
        ]
    ];
    
    public function insert($name, $text, $parent, $parentId) 
    {
        $data = $this->db->query(
                    "INSERT INTO comments (comment_author, comment_text, parent, comment_product) VALUES (:comment_author, :comment_text, :parent, :productId)", [
                    'comment_author' => $name,
                    'comment_text' => $text,
                    'parent' => $parent,
                    'productId' => $parentId
        ]);
        
        $this->lastCommentId = $this->db->lastInsertId();
        
        return $data;
    }
    
    public function getCommentByLastId($id) 
    {
        return $this->db->query("SELECT * FROM `comments` WHERE comment_id=:id LIMIT 1", [
                    'id' => $id,
                    ], \PDO::FETCH_ASSOC)[0];
    }
    
}