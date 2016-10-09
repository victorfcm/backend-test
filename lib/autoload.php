<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 17:53
 */

// SIMPLE AUTOLOAD
spl_autoload_register(

    function( $classname ) {

        require_once str_replace( '\\', DIRECTORY_SEPARATOR, $classname ) . '.php';
    }

);