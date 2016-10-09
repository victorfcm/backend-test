<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 18:10
 */

namespace Catho\Test;

require 'lib/autoload.php';

use Catho\Request;
use PHPUnit_Framework_TestCase as PHPUnit;

/**
 * Class RequestTest.
 * Test class of the request itself.
 * @package Catho\Test
 */
class RequestTest extends PHPUnit
{
    /**
     * Test if the request result will be empty.
     */
    public function testRequestResultEmptiness()
    {
        $request = new Request(['term' => 'Coordenador', 'city' => 'Porto']);
        $this->assertNotEmpty($request->process(false)->getCollection());
    }
}