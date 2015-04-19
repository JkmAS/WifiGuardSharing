<?php

/**
 * Controller for app
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php/controllers
 * @version 1.0.0
 */
class App extends Controller {
    
    /**
    * Constructor
    */
    public function __construct() {
        parent::__construct();
        $this->work();
        parent::giveResult();
    }
    
    /**
    * Transmit data to models
    */
    public function work() {
        $this->helpmodel = new UserAdmin();
        //control validity of user session        
        $this->helpmodel->controlSession();
        
//        if($_SERVER["REQUEST_METHOD"] == "POST"){ 
//            //todo
//        }    
        
        if($_SERVER["REQUEST_METHOD"] == "GET"){ 
            if (isset($_GET["page"])){
                if($_GET["page"]==="logout"){
                    $this->model = new UserAdmin();
                    $this->model->logout();
                }
                elseif($_GET["page"]==="upload"){
                    $this->model = new Uploader();
                    $this->model->__setView();
                }
                elseif($_GET["page"]==="showrecord"){
                    $this->model = new ShowRecord();
                    $this->model->showFiles();
                    $this->model->__setView();
                }
            }
        } 
        
        //ajax
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
            if(isset($_FILES["files"])){
                $this->model = new Uploader();
                $this->model->uploadFiles($_FILES["files"]);
            }
        }
    }
}
