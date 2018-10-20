<?php declare(strict_types=1);

namespace engine;

/**
 * class Request realize wrapper for global variables PHP
 *
 * @author Sergey
 */
class Request 
{
    /**
     *
     * @var array
     */
    public $get = [];
    
    /**
     *
     * @var array
     */
    public $post = [];
    
    /**
     *
     * @var array
     */
    public $request = [];
    
    /**
     *
     * @var array
     */
    public $session = [];
    
    /**
     *
     * @var array
     */
    public $cookie = [];
    
    /**
     *
     * @var array
     */
    public $files = [];
    
    /**
     *
     * @var array
     */
    public $server = [];
    
    /**
     * Include trait TSingletone
     */
    use TraitSingletone;
    
    /**
     * Request constructor
     */
    public function __construct() 
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->request = $_REQUEST;
        $this->cookie = $_COOKIE;
        $this->session = $_SESSION;
        $this->files = $_FILES;
        $this->server = $_SERVER;
    }
}