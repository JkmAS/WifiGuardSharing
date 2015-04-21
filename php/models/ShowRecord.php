<?php

/**
 * Show all data of user
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php/models
 * @version 1.0.0
 */
class ShowRecord extends Model {
    
    /**
    * Constructor
    */
    public function __construct() {   
        parent::__construct();    
        $this->data = [
            'quantity' => null,
            'files' => null,
            'XMLOutput' => null
        ];
        DBCommunicator::connectDibi();
    }
    
    /**
    * Show list of files
    */
    public function showFiles(){
        $email = $_SESSION['wifiGuardSharingEmail'];
        $result = dibi::query('SELECT name
                               FROM [files]
                               WHERE [email] = %s', $email);
        $files = $result->fetchAll();
                
        $this->data['quantity'] = count($files);
        if ($this->data['quantity'] != 0){
            $this->data['files'] = [];
            foreach ($files as $value) {
                array_push($this->data['files'], $value['name']);
            }
        } else {
            $this->data['files'] = "No records";
        }
    } 
    
    /**
    * Transform XML with XSLT
    */
    public function transformXML($fileXML){
        $dir = "files/";
        $fileXML = $dir.$fileXML;
        //XML not exist, show nothing
        if(!file_exists($fileXML)){
            return;
        }
        //load xml file
        $xml = new DOMDocument();
        $xml->load($fileXML);
        //load xsl file
        $xsl = new DOMDocument();
        $xsl->load("php/models/record.xsl");
        //transform
        $proc = new XSLTProcessor();
        $proc->importStylesheet($xsl);
        $this->data['XMLOutput'] = $proc->transformToXml($xml);         
    }
    
    /**
    * Setting view
    */
    public function __setView() {
        $this->view = "php/views/record.html";
    }
}
