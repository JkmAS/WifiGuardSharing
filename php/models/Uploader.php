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
    * Function for uploading files to server via ajax
    * @param file files Files form $_Files
    * @return array Array of messages
    */
    public function uploadFiles($files){
        $validFormat = ["xml"];
        $dir = "files/".$_SESSION['wifiGuardSharingEmail']."/"; 
        $output = array();
        
        foreach ($files['name'] as $file => $fileName) { 
            //4 No file was uploaded
            if ($files['error'][$file] == 4) {
                $this->message = ["error", "File $fileName is not uploaded"];
                array_push($output, $this->message);
                continue;
            }	       
            //0 There is no error
            if ($files['error'][$file] == 0) {	
                //control valid format of extension
                $fileInfo = pathinfo($fileName, PATHINFO_EXTENSION);
                if(!in_array($fileInfo, $validFormat)){
                    $this->message = ["error", "File $fileName is not in valid format"];
                    array_push($output, $this->message);
                    continue;
                } elseif(file_exists($dir.$fileName)){
                    $this->message = ["error", "File $fileName already exists"];
                    array_push($output, $this->message);
                    continue;
                } else{ 
                    move_uploaded_file($files["tmp_name"][$file], $dir.$fileName);
                    //Is XML valid against XML Schema?
                    if ($this->validateXML($dir.$fileName) === false){
                        $this->message = ["error", "File $fileName is not valid against schema"];
                        array_push($output, $this->message);
                        unlink($dir.$fileName);
                        continue;
                    } else {                    
                        $arr = [
                            'email' => $_SESSION['wifiGuardSharingEmail'],
                            'name' => $fileName              
                        ];
                        dibi::query('INSERT INTO [files]', $arr); 
                        $this->message = ["info", "File $fileName was uploaded"];
                        array_push($output, $this->message);
                    }
                }
            }                        
        }
        die(json_encode($output));
    }  
    
    /**
    * Control validity of XML
    * @param string xmlFile XML file name
    * @return boolean True if the XML is valid
    */
    public function validateXML($xmlFile){
        //Because of throwing errors from validation
        libxml_use_internal_errors(true);
        $xml = new DOMDocument(); 
        $xml->load($xmlFile); 
        if (!$xml->schemaValidate('php/models/record.xsd')) {
            return false;
        }else{
            return true;
        }    
    }

    /**
    * Setting view
    */
    public function __setView() {
        $this->view = "php/views/upload.html";
    }
}
