<?php declare(strict_types=1);

namespace engine\base;

use engine\Database;
use Valitron\Validator as V;

/**
 * Class Model
 *
 * @author Sergey
 */
abstract class Model 
{
    /**
     * Attribute model
     * 
     * @var array
     */
    public $attributes = [];
    
    /**
     * Errors validation
     * 
     * @var array
     */
    public $errors = [];
    
    /**
     * Rules validation
     * 
     * @var array
     */
    public $rules = [];
    
    /**
     * Database
     * 
     * @var object Database
     */
    public $db;
    
    /**
     * Constructor Model
     */
    public function __construct() 
    {
        $settings = require CONF . '/config_db.php';
        $this->db = new Database($settings);
    }
    
    /**
     * Load data
     * 
     * @param array $data
     */
    public function load(array $data): void
    {
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }
    
    /**
     * Validation data
     * 
     * @param array $data
     * @return bool
     */
    public function validate(array $data = []): bool 
    {
        V::lang('ru');
        $v = new V($data);
        $v->rules($this->rules);
        
        if ($v->validate()) {
            return true;
        } else {
           $this->errors = $v->errors();
           return false;
        }
        
    }
    
    /**
     * Get all errors
     */
    public function getErrors(): void
    {
        $errors = '<ul>';
        
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= '<li>';
                $errors .= $item;
                $errors .= '</li>';
            }
        }
        
        $errors .= '</ul>';
        $_SESSION['validate_errors'] = $errors;
    }
}
