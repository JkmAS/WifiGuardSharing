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
        //Because of array of models
        foreach($this->model as $model) {
            $this->message = $model->__getMessage();
            $this->data = $model->__getData();
            $this->view = $model->__getView();
        }       
    }
    
    /**
    * Return data to Router
    * @return array output
    */
    public function __getOutput(){
        if (empty($this->message)){
            $this->message = ["info","Log in please"];
        }
        $output = [
            'message'=>$this->message,
            'data'=>$this->data,
            'view'=>$this->view
        ];
        return $output;
    }
}
