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
                'model' => 'models/'.$class.'.php',
                'controller' => 'controllers/'.$class.'.php'
            );
            if (file_exists($dir['model'])){
                include $dir['model'];
            }
            elseif (file_exists($dir['controller'])){
                include $dir['controller'];
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
