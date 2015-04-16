<?php

/**
 * Description of Login
 *
 * @author jkmas
 */
class UserAdmin {
   
    public $showMessage = null;  
        
    public function __construct() {       
        DBCommunicator::connectDibi();
    }
    
    public function login($email, $password){
        if(empty($email)){ 
            $this->showMessage = ["error", "Missing e-mail"];;
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->showMessage = ["error", "Email is not valid"];
        }
        elseif(empty($password)){ 
            $this->showMessage = ["error", "Missing password"];
        } else {
            $result = dibi::query('SELECT password
                                   FROM [user]
                                   WHERE [email] = %s', $email);
            $password_hash = $result->fetchSingle();
            
            if (password_verify($password, $password_hash)) {
                $_SESSION['wifiGuardSharingEmail'] = $email;
                $this->redirection("app.php");
            } else {
                $this->showMessage = ["error", "Invalid username or password"];
            }
        }
    }
    
    public function registr($email, $password, $confirmPassword){
        if(empty($email)){ 
            $this->showMessage = ["error", "Missing email"];
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->showMessage = ["error", "Email is not valid"];
        }
        elseif(empty($password)){ 
            $this->showMessage = ["error", "Missing password"];
        }
        elseif(empty($confirmPassword)){
            $this->showMessage = ["error", "Missing confirm password"];
        }
        elseif ($password != $confirmPassword) {     
            $this->showMessage = ["error", "Passwords do not match"];
        } else {            
            $result = dibi::query('SELECT COUNT(*)
                                   FROM [user]
                                   WHERE [email] = %s', $email, 'LIMIT 1');
            $userExist = $result->fetchSingle();
            if ($userExist){     
                $this->showMessage = ["error", "User already exists"];
            }        
            else {              
                //password_hash, PASSWORD_BCRYPT = BLOWFISH
                $options = array(
                    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
                    'cost' => 12
                );
                $password_result = password_hash($password, PASSWORD_BCRYPT, $options);
                                
                $arr = array(
                    'email' => $email,
                    'password' => $password_result                
                );
                dibi::query('INSERT INTO [user]', $arr); 
                $_SESSION['wifiGuardSharingEmail'] = $email;
                $this->redirection("app.php");
            }
            
        }
    }    
    
    public function logout(){
        session_destroy();
        $this->redirection("index.php");
    }
    
    public function controlSession(){
        $session = $_SESSION['wifiGuardSharingEmail'];
        if(!empty($session)){
            $result = dibi::query('SELECT COUNT(*)
                                   FROM [user]
                                   WHERE [email] = %s', $session, 'LIMIT 1');
            $userExist = $result->fetchSingle();
            if ($userExist){
                $this->redirection("app.php");
            }
        }
    }
    
    public function __getMessage(){
        return $this->showMessage;
    } 
    
    private function redirection($url){
        header("Location: $url");
        exit;     
    }    
}
