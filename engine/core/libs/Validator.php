<?php

namespace engine\libs;

/**
 * Class for validation data
 *
 * @author sergey
 */
class Validator 
{
    public $data = [];
    private $validate = true;
    public $errors = [];

    public function __construct($data) 
    {
        $this->data = $data;
        debug($this->data);
    }
    
    public function validate() 
    {
        return $this->validate;
    }
    
    public function errors() 
    {
        
    }
}
