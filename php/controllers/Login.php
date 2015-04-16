<?php

/**
 * Description of Login
 *
 * @author jkmas
 */
class Login {
    public function __construct() { 
        $this->model = new UserAdmin();
    }
       
    public function work(){
        
        $this->model->controlSession();
                
        if (isset($_POST["login"])){
            if(isset($_POST["email"]) && isset($_POST["password"])){    
                $this->model->login($_POST["name"], $_POST["password"]); 
            }
        }
        if (isset($_POST["registration"])){
            if(isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirmPassword"])){    
                $this->model->registr($_POST["name"], $_POST["password"], $_POST["confirmPassword"]);
            }
        }
    }    
}
