<?php

/**
 * Description of DBCommunicator
 *
 * @author jkmas
 */
class DBCommunicator {

    public static function connectDibi(){
        dibi::connect(array(
            'driver'   => 'mysql',
            'host'     => 'wm40.wedos.net',
            'username' => 'w48301_wgs',
            'password' => '****',
            'database' => 'd48301_wgs',
            'charset'  => 'utf8',
        ));    
    }
}
