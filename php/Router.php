<?php

/**
 * Description of Router
 *
 * @author jkmas
 */
require_once 'Login.php';
require_once 'ShowRecord.php';
require_once 'Uploader.php';
require_once 'Error.php';

class Router {    
    public $output;
    
    public function __construct() {
        session_start();        
        $this->loadController();
        
    }
    
    public function loadController(){
        $uri = $_SERVER['REQUEST_URI']; 
        switch ($uri) {
            case 'index.php':
                new Login();
                break;                
            case 'app.php':
                
                $par = "";//TODO
                
                if($par == "show"){
                    new ShowRecord();
                    break;
                }
                if($par == "upload"){
                    new Uploader();
                    break;
                } 
                if($par == "logout"){
                    new Login();
                    break;
                }               
            default:
                new Error();
                break;
        }
    }
    
    
}
