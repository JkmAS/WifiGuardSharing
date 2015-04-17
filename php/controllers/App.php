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
        $this->model = [
            'userAdmin' => new UserAdmin(),
            'uploader' => new Uploader(),
            'showRecord' => new ShowRecord()
        ];
        $this->work();
        parent::giveResult();
    }
    
    /**
    * Transmit data to models
    */
    public function work() {
        //control validity of user session
        $this->model['userAdmin']->controlSession();
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){ 
            //todo
        }      
        if($_SERVER["REQUEST_METHOD"] == "GET"){ 
            if (isset($_GET["page"])){
                if($_GET["logout"]){
                    $this->model['userAdmin']->logout();
                }
                elseif($_GET["upload"]){
                    $this->model['uploader']->__setView();
                }
                elseif($_GET["showrecord"]){
                    $this->model['showRecord']->__setView();
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
