<?php

/**
 * Abstract class Model
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php/models
 * @version 1.0.0
 */
abstract class Model {
    
    public $message = null;
    public $data = null;
    public $view = null;
    
    /**
    * Constructor
    */
    public function __construct() {        
    }
    
    /**
    * Getters
    */
    public function __getMessage(){
        return $this->message;
    }
    public function __getData(){
        return $this->data;
    }
    public function __getView(){
        return $this->view;
    }    
    
    /**
    * Redirect to other website
    */
    protected function redirection($url){
        header("Location: $url");
        exit;     
    } 
}
