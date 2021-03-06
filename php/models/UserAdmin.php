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
                $this->__setSession($email);
                parent::redirection("app.php?page=showrecord");
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
                $this->__setSession($email);
                mkdir("files/".$email, 0700);
                parent::redirection("app.php?page=showrecord");
            }            
        }
    }    
    
    /**
    * Log out user and redirect to index
    */
    public function logout(){
        session_destroy();
        $arr = array(
           'sessionID' => ''
           );
        dibi::query('UPDATE `user` SET ', $arr, 
                    'WHERE `email`=%s', $email);
        parent::redirection("index.php");
    }
    
    /**
    * Set session and sessionID
    * @param string email Email of user 
    */
    private function __setSession($email){
        $_SESSION['wifiGuardSharingEmail'] = $email;
        $sessionID = sha1(uniqid(mt_rand()).$_SERVER['REMOTE_ADDR']);
        $_SESSION["wifiGuardSharingID"] = $sessionID; 
        $arr = array(
           'sessionID' => $sessionID
           );
        dibi::query('UPDATE `user` SET ', $arr, 
                    'WHERE `email`=%s', $email);
    }
    
    /**
    * Control validity of session
    */
    public function controlSession(){
        $session = $_SESSION['wifiGuardSharingEmail'];
        $sessionID = $_SESSION["wifiGuardSharingID"];
        $uri = $_SERVER['REQUEST_URI'];
               
        if(!empty($session) && !empty($sessionID)){
            $result = dibi::query('SELECT sessionID
                                   FROM [user]
                                   WHERE [email] = %s', $session, 'LIMIT 1');
            $databaseSessionID = $result->fetchSingle();
            
            //if user is in index.php with valid session
            if (preg_match("/index.php/",$uri) && $databaseSessionID===$sessionID){
                parent::redirection("app.php?page=showrecord");
            }
            //if user try load app.php with invalid session
            elseif (preg_match("/app.php/",$uri) && $databaseSessionID!==$sessionID){
                parent::redirection("index.php");
            }
        } 
        //if user try load app.php without session
        elseif(preg_match("/app.php/",$uri)){
            parent::redirection("index.php");
        }
    }
}
