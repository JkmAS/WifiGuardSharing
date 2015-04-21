<?php

/**
 * Abstract class Controller
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php/controllers
 * @version 1.0.0
 */
abstract class Controller {
    protected $model = null;
    protected $helpmodel = null;
    public $message = null;
    public $data = null;
    public $view = null;
    
    /**
    * Constructor
    */
    public function __construct() {        
    }
    
    /**
    * Abstract function work
    */
    abstract function work();
    
    /**
    * Get data from models, calling form childer of Controller
    */
    public function giveResult(){
        $this->message = $this->model->__getMessage();
        $this->data = $this->model->__getData();
        $this->view = $this->model->__getView();        
    }
               
    /**
    * Return data to Router
    * @return array output
    */
    public function __getOutput(){        
        $output = [
            'message'=>$this->message,
            'data'=>$this->data,
            'view'=>$this->view
        ];
        return $output;
    }
}
