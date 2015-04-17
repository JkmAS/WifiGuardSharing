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
        $this->model = [
            'userAdmin' => new UserAdmin()
        ];    
        $this->work();
        parent::giveResult();
    }
    
    /**
    * Transmit data to models
    */
    public function work(){       
        //control validity of user session
        $this->model->controlSession();
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){        
            if (isset($_POST["login"])){
                if(isset($_POST["email"]) && isset($_POST["password"])){    
                    $this->model['userAdmin']->login($_POST["email"], $_POST["password"]); 
                }
            }
            if (isset($_POST["registration"])){
                if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirmPassword"])){    
                    $this->model['userAdmin']->registr($_POST["email"], $_POST["password"], $_POST["confirmPassword"]);
                }
            }
        }
    }
}
