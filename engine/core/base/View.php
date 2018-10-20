<?php declare(strict_types=1);

namespace engine\base;

/**
 * Class View
 *
 * @author Sergey
 */
class View 
{

    /**
     * Current routes and params (controller, action, params)
     * 
     * @var array
     */
    public $route = [];
    
    /**
     * Current view
     * 
     * @var string
     */
    public $view;
    
    /**
     * Current template
     * 
     * @var string
     */
    public $layout;
    
    /**
     * JavaScript scripts
     * 
     * @var arrat
     */
    public $scripts = [];
    
    /**
     * Meta tags info
     * 
     * @var array
     */
    public static $meta = ['title' => '', 'desc' => '', 'keywords' => ''];
    
    /**
     * Constructor View 
     * 
     * @param type $route
     * @param type $layout
     * @param type $view
     */
    public function __construct($route, $layout = '', $view = '') 
    {
        $this->route = $route;
        
        if ($layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        
        $this->view = $view;
    }
    
    /**
     * Compress page
     * 
     * @param type $buffer
     * @return type
     */
    protected function compressPage($buffer)
    {
        $search = [
            "/(\n)+/",
            "/\r\n+/",
            "/\n(\t)+/",
            "/\n(\ )+/",
            "/\>(\n)+</",
            "/\>\r\n</",
        ];
        $replace = [
            "\n",
            "\n",
            "\n",
            "\n",
            '><',
            '><',
        ];
        return preg_replace($search, $replace, $buffer);
    }
    
    /**
     * Render view
     * 
     * @param array $vars
     * @throws \Exception
     */
    public function render(array $vars = []): void
    {
        $this->route['prefix'] = str_replace('\\', '/', $this->route['prefix']);
        
        if (is_array($vars)) extract($vars);
        
        $file_view = APP . "/views/{$this->route['prefix']}{$this->route['controller']}/{$this->view}.php";
        
        ob_start();
        {
            if (is_file($file_view)) {
                
                require $file_view;
                
            } else {
                throw new \Exception("<p>Не найден вид <b>$file_view</b></p>", 404);
            }

            $content = ob_get_contents();
        }
        ob_clean();
        
        if (false !== $this->layout) {
            
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            
            if (is_file($file_layout)) {
                
                $content = $this->getScript($content);
                $scripts = [];
                
                if (!empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }
                
                require $file_layout;
                
            } else {
                throw new \Exception("<p>Не найден шаблон <b>$file_layout</b></p>", 404);
            }
        }
    }
    
    /**
     * Get js scripts
     * 
     * @param type $content
     * @return string
     */
    protected function getScript(string $content): string
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
        
        if(!empty($this->scripts)){
            $content = preg_replace($pattern, '', $content);
        }
        
        return $content;
    }
    
    /**
     * Get meta
     */
    public static function getMeta(): void
    {
        echo '<title>' . self::$meta['title'] . '</title>
        <meta name="description" content="' . self::$meta['desc'] . '">
        <meta name="keywords" content="' . self::$meta['keywords'] . '">';
    }
    
    /**
     * Set meta tags for view
     * 
     * @param string $title
     * @param string $desc
     * @param string $keywords
     */
    public static function setMeta(string $title = '', string $desc = '', string $keywords = ''): void
    {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;
    }
}
