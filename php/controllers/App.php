<?php

/**
 * Controller for app
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php/controllers
 * @version 1.0.0
 */
class App extends Controller {
    
    /**
    * Constructor
    */
    public function __construct() {
        parent::__construct();
        $this->work();
        parent::giveResult();
    }
    
    /**
    * Transmit data to models
    */
    public function work() {
        
    }
}
