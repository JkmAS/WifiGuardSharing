<?php

/**
 * Show all data of user
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php/models
 * @version 1.0.0
 */
class ShowRecord extends Model {
    //put your code here
    
    /**
    * Setting view
    */
    public function __setView() {
        $this->view = "php/views/record.html";
    }
}
