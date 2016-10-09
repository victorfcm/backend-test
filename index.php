<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 17:13
 */

require 'lib/autoload.php';

use Catho\Request;

// CREATES THE REQUEST, AND SET THE $_GET AS PARAMETER
$request = new Request($_GET);

// THEN PROCESS IT
$request->process();