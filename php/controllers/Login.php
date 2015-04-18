<?php

/**
 * Controller for login
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php/controllers
 * @version 1.0.0
 */
class Login extends Controller{
    
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
    public function work(){       
        $this->model = new UserAdmin();
        //control validity of user session
        $this->model['userAdmin']->controlSession();
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){        
            if (isset($_POST["login"])){
                if(isset($_POST["email"]) && isset($_POST["password"])){    
                    $this->model->login($_POST["email"], $_POST["password"]); 
                }
            }
            if (isset($_POST["registration"])){
                if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirmPassword"])){    
                    $this->model->registr($_POST["email"], $_POST["password"], $_POST["confirmPassword"]);
                }
            }
        }
    }
}
