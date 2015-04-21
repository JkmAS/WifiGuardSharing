<?php

/**
 * Error class - 404 Nof Found
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php/models
 * @version 1.0.0
 */
class Error extends Model {
    /**
    * Constructor
    */
    public function __construct() {   
        parent::__construct(); 
        header("HTTP/1.0 404 Not Found");
    }
    /**
    * Setting view
    */
    public function __setView() {
        $this->view = "php/views/error.html";
    }
}
