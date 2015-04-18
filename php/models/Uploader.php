<?php

/**
 * For uploading files to server
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php/models
 * @version 1.0.0
 */
class Uploader extends Model {
    
    /**
    * Constructor
    */
    public function __construct() {   
        parent::__construct();
        DBCommunicator::connectDibi();        
    }
    
    /**
    * Function for uploading files to server
    * @param file files Files form $_Files
    */
    public function uploadFiles($files){
        $validFormat = "xml";
        $dir = "files/"; 

        foreach ($files['name'] as $file => $fileName) { 
            //4 No file was uploaded
            if ($files['error'][$file] == 4) {
                $this->message = ["error", "$fileName is not uploaded"];
                continue;
            }	       
            //0 There is no error
            if ($files['error'][$file] == 0) {	
                //control valid format
                $fileInfo = pathinfo($fileName, PATHINFO_EXTENSION);
                if(!in_array($fileInfo, $validFormat)){
                    $this->message = ["error", "$fileName is not a valid format"];
                    continue;
                } elseif(file_exists($dir.$fileName)){
                    $this->message = ["error", "$fileName already exists"];
                    continue;
                }
                else{ 
                    move_uploaded_file($files["tmp_name"][$fileName], $dir.$fileName);
                    $arr = [
                        'email' => $_SESSION['wifiGuardSharingEmail'],
                        'name' => $fileName              
                    ];
                    dibi::query('INSERT INTO [files]', $arr); 
                    $this->message = ["info", "Success"];
                }
            }
        }
    }  
    
    /**
    * Setting view
    */
    public function __setView() {
        $this->view = "php/views/upload.html";
    }
}
