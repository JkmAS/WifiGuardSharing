<?php

/**
 * Router in MVC
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php
 * @version 1.0.0
 */

class Router {    
    
    //controller
    public $controller = null;
    
    /**
    * Constructor
    */
    public function __construct() {
        //session start
        session_start(); 
        
        //auto include php files
        spl_autoload_register(function ($class){            
            $dir = [
                'model' => 'php/models/'.$class.'.php',
                'controller' => 'php/controllers/'.$class.'.php',
                'lib' => 'lib/dibi/dibi.min.php'
            ];   
            if (file_exists($dir['model'])){
                include $dir['model'];
            }
            elseif (file_exists($dir['controller'])){
                include $dir['controller'];
            } 
            elseif (file_exists($class.'.php')) {
                include $class.'.php';
            }
            elseif (file_exists($dir['lib'])) {
                include $dir['lib'];
            }
        });
        
        $this->loadController();
    }
    
    /**
    * Load the controller
    */
    public function loadController(){
        $uri = $_SERVER['REQUEST_URI'];
        if (preg_match("/index.php/", $uri)){
            $this->controller = new Login();
        }
        if (preg_match("/app.php/", $uri)){
            $this->controller = new App();
        }
    }
    
    /**
    * Get data from controller, applied in HTML
    * @return array output
    */
    public function __getData(){
        return $this->controller->__getOutput();
    }
}
