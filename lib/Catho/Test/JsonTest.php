<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 17:38
 */

namespace Catho\Test;

require 'lib/autoload.php';

use Catho\Json;
use PHPUnit_Framework_TestCase as PHPUnit;

/**
 * Class JsonTest
 * @package Catho\Test
 */
class JsonTest extends PHPUnit
{
    /**
     * Test the type of the output.
     */
    public function testType()
    {
        $json = new Json('vagas.json');
        $this->assertInternalType('object', $json->jsonObject);
    }

    /**
     * Test the count of the objects generated on the JSON.
     */
    public function testCountObjects()
    {
        $json = new Json('vagas.json');
        $objects = $json->jsonObject->docs;
        $this->assertEquals(1200, count($objects));
    }
}