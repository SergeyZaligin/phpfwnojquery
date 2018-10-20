<?php declare(strict_types=1);

namespace engine;

use engine\libs\Common;

/**
 * Main class application App
 *
 * @author Sergey
 */
class App 
{
    /**
     * Object Registry realise pattern reestr
     * 
     * @var oject Registry
     */
    public static $app;
    
    /**
     * Constructor App
     */
    public function __construct() 
    {   
        // Start session
        session_start();
        // Reestr
        self::$app = Registry::instance();
        // request handler
        self::$app->request = Request::instance();
        // Get query string
        $query = Common::getQueryString();
        
        // add params in reestr
        $this->getParams();
        // error handler exception
        new ErrorHandler();
        // routing
        Router::dispatch((string)$query);
    }
    
    /**
     * Method getParams write property in $app
     * 
     * @return void
     */
    protected function getParams(): void 
    {
        $params = require_once CONF . '/params.php';
        
        if (!empty($params)&& is_array($params)) {
            
            foreach ($params as $key => $value) {
                self::$app->setProperty($key, $value);
            }
            
        }
    }

}
