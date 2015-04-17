<?php

/**
 * Settings for Dibi database layer
 *
 * @author jkmas <jkmasg@gmail.com>
 * @package php/models
 * @version 1.0.0
 */
class DBCommunicator {
    
    /**
    * Connect to database
    */
    public static function connectDibi(){
        dibi::connect([
            'driver'   => 'mysql',
            'host'     => 'wm40.wedos.net',
            'username' => 'w48301_wgs',
            'password' => '***',
            'database' => 'd48301_wgs',
            'charset'  => 'utf8',
        ]);    
    }
}
