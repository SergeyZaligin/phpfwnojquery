<?php //declare(strict_types=1);

namespace engine;

/**
 * Router app
 *
 * @author Sergey
 */
class Router 
{
    /**
     * Table routes
     * 
     * @var array
     */
    protected static $routes = [];
    
    /**
     * Current route
     * 
     * @var array
     */
    protected static $route = [];
    
    /**
     * Add route in table routes
     * 
     * @param string $regexp regexp route
     * @param array $route route ([controller, action, params])
     */
    public static function add($regexp, $route = []): void
    {
        self::$routes[$regexp] = $route;
    }
    
    /**
     * Return table routes
     * 
     * @return array
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }
    
    /**
     * Return current route (controller, action, [params])
     * 
     * @return array
     */
    public static function getRoute(): array 
    {
        return self::$route;
    }
    
    /**
     * URL in table routes
     * 
     * @param string $url incoming URL
     * @return boolean
     */
    public static function matchRoute($url) 
    {
        foreach (self::$routes as $pattern => $route) {
            
            if (preg_match("#$pattern#i", $url, $matches)) {
                
                foreach ($matches as $k => $v) {
                    
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                    
                }
                if (!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                // prefix for admin controllers
                if (!isset($route['prefix'])) {
                    $route['prefix'] = '';
                } else {
                    $route['prefix'] .= '\\';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
            
        }
        return false;
    }
    
    /**
     * Redirect URL on correct route
     * 
     * @param string $url incoming URL
     * @return void
     */
    public static function dispatch($url): void
    {
        $url = self::removeQueryString($url);
        
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
            
            if (class_exists($controller)) {
                
                $cObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . 'Action';
                
                if (method_exists($cObj, $action)) {
                    
                    $cObj->$action();
                    $cObj->getView();
                    
                } else {
                    throw new \Exception("Метод <b>$controller::$action</b> не найден", 404);
                }
            } else {
                throw new \Exception("Контроллер <b>$controller</b> не найден", 404);
            }
        } else {
            throw new \Exception("Страница не найдена", 404);
        }
    }
    
    /**
     * Converts name at view  CamelCase
     * 
     * @param string $name string for convert
     * @return string
     */
    protected static function upperCamelCase($name): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }
    
    /**
     * Converts name at view camelCase
     * 
     * @param string $name string for convert
     * @return string
     */
    protected static function lowerCamelCase(string $name): string
    {
        return lcfirst(self::upperCamelCase($name));
    }
    
    /**
     * Return string without GET params
     * 
     * @param string $url query URL
     * @return mixed string|null
     */
    protected static function removeQueryString(string $url)
    {
        if ($url) {
            
            $params = explode('&', $url, 2);
            
            if (false === strpos($params[0], '=')) {
                
                return rtrim($params[0], '/');
                
            } else {
                return '';
            }
        }
    }
    
}
