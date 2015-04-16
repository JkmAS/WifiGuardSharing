<?php

/**
 * Description of Router
 *
 * @author jkmas
 */

//todo vyřešit zprávy

class Router {    
    
    public function __construct() {
        session_start(); 
        spl_autoload_register(function ($class){            
            $dir = array(
                'model' => 'php/models/'.$class.'.php',
                'controller' => 'php/controllers/'.$class.'.php',
                'lib' => 'lib/dibi/dibi.min.php'
            );   
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
    
    public function loadController(){
        $uri = $_SERVER['REQUEST_URI']; 
        if (preg_match("/index.php/", $uri)){
            new Login();
        }
        if (preg_match("/app.php/", $uri)){
            new App();
        }
    }
}
