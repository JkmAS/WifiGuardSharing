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
            'host'     => 'XXX.wedos.net',
            'username' => 'name',
            'password' => '****',
            'database' => 'nameDatabase',
            'charset'  => 'utf8',
        ));    
    }
}
