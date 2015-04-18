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
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){ 
            //todo
        }      
        if($_SERVER["REQUEST_METHOD"] == "GET"){ 
            if (isset($_GET["page"])){
                if($_GET["page"]==="logout"){
                    $this->model = UserAdmin();
                    $this->model->logout();
                }
                elseif($_GET["page"]==="upload"){
                    $this->model = new Uploader();
                    $this->model->__setView();
                }
                elseif($_GET["page"]==="showrecord"){
                    $this->model = new ShowRecord();
                    $this->model->__setView();
                }
            }
        }  
        //ajax
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
            if(isset($_POST["upload"])){
                $this->model['upload']->uploadFiles($_FILES["files"]);
            }
        }
    }
}
