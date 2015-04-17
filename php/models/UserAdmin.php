<?php

/**
 * User administration 
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php/models
 * @version 1.0.0
 */
class UserAdmin extends Model {
    
    /**
    * Constructor
    */
    public function __construct() {   
        parent::__construct();
        DBCommunicator::connectDibi();
    }
    
    /**
    * Login and control input from user
    * @param string email Email of user
    * @param string password Password of user
    */
    public function login($email, $password){
        if(empty($email)){ 
            $this->message = ["error", "Missing e-mail"];;
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->message = ["error", "Email is not valid"];
        }
        elseif(empty($password)){ 
            $this->message = ["error", "Missing password"];
        } else {
            $result = dibi::query('SELECT password
                                   FROM [user]
                                   WHERE [email] = %s', $email);
            $password_hash = $result->fetchSingle();
            
            if (password_verify($password, $password_hash)) {
                $_SESSION['wifiGuardSharingEmail'] = $email;
                parent::redirection("app.php");
            } else {
                $this->message = ["error", "Invalid username or password"];
            }
        }
    }
    
    /**
    * Registr and control input from user
    * @param string email Email of user
    * @param string password Password of user
    * @param string confirmPassword Password of user 
    */
    public function registr($email, $password, $confirmPassword){ 
        if(empty($email)){ 
            $this->message = ["error", "Missing email"];
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->message = ["error", "Email is not valid"];
        }
        elseif(empty($password)){ 
            $this->message = ["error", "Missing password"];
        }
        elseif(empty($confirmPassword)){
            $this->message = ["error", "Missing confirm password"];
        }
        elseif ($password != $confirmPassword) {     
            $this->message = ["error", "Passwords do not match"];
        } else {       
            $result = dibi::query('SELECT COUNT(*)
                                   FROM [user]
                                   WHERE [email] = %s', $email, 'LIMIT 1');
            $userExist = $result->fetchSingle();
            if ($userExist){     
                $this->message = ["error", "User already exists"];
            }        
            else {   
                //password_hash, PASSWORD_BCRYPT = BLOWFISH
                $options = [
                    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
                    'cost' => 12
                ];
                $password_result = password_hash($password, PASSWORD_BCRYPT, $options);
                                
                $arr = [
                    'email' => $email,
                    'password' => $password_result                
                ];
                dibi::query('INSERT INTO [user]', $arr); 
                $_SESSION['wifiGuardSharingEmail'] = $email;
                parent::redirection("app.php");
            }            
        }
    }    
    
    /**
    * Log out user and redirect to index
    */
    public function logout(){
        session_destroy();
        parent::redirection("index.php");
    }
    
    /**
    * Control validity of session
    */
    public function controlSession(){
        $session = $_SESSION['wifiGuardSharingEmail'];
        if(!empty($session)){
            $result = dibi::query('SELECT COUNT(*)
                                   FROM [user]
                                   WHERE [email] = %s', $session, 'LIMIT 1');
            $userExist = $result->fetchSingle();
            if ($userExist){
                parent::redirection("app.php");
            }
        }
    }
}
