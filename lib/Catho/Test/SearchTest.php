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
use Catho\JobCollection;
use Catho\Search;
use PHPUnit_Framework_TestCase as PHPUnit;

/**
 * Class SearchTest
 * @package Catho\Test
 */
class SearchTest extends PHPUnit
{
    /**
     * Test the simple term search and see if the result it's empty.
     * @throws \Catho\Exception\TypeException
     */
    public function testTermResults()
    {
        $json = new Json('vagas.json');
        $jobCollection = new JobCollection($json);
        $search = new Search($jobCollection);
        $search->term('Analista');

        $this->assertNotEmpty($search->getResult()->getCollection());
    }

    /**
     * Test the same test above count.
     * @throws \Catho\Exception\TypeException
     */
    public function testTermCount()
    {
        $json = new Json('vagas.json');
        $jobCollection = new JobCollection($json);
        $search = new Search($jobCollection);
        $search->term('Analista');

        $this->assertEquals(79, $search->getResult()->count());
    }

    /**
     * Test the simple city search and see if the result it's empty.
     * @throws \Catho\Exception\TypeException
     */
    public function testCityResult()
    {
        $json = new Json('vagas.json');
        $jobCollection = new JobCollection($json);
        $search = new Search($jobCollection);
        $search->city('Porto Alegre');

        $this->assertNotEmpty($search->getResult()->getCollection());
    }

    /**
     * Test the same test above count.
     * @throws \Catho\Exception\TypeException
     */
    public function testCityCount()
    {
        $json = new Json('vagas.json');
        $jobCollection = new JobCollection($json);
        $search = new Search($jobCollection);
        $search->city('Porto Alegre');

        $this->assertEquals(356, $search->getResult()->count());
    }

    /**
     * Test the simple city search and see if the result it's empty.
     * @throws \Catho\Exception\EmptyException
     * @throws \Catho\Exception\TypeException
     */
    public function testWageResult()
    {
        $json = new Json('vagas.json');
        $jobCollection = new JobCollection($json);
        $search = new Search($jobCollection);
        $search->wage(10000);

        $this->assertNotEmpty($search->getResult()->getCollection());
    }

    /**
     * Test the same test above count.
     * @throws \Catho\Exception\EmptyException
     * @throws \Catho\Exception\TypeException
     */
    public function testWageCount()
    {
        $json = new Json('vagas.json');
        $jobCollection = new JobCollection($json);
        $search = new Search($jobCollection);
        $search->wage(8500, 11000);

        $this->assertEquals(2, $search->getResult()->count());
    }

    /**
     * Test a multiple search, including city and wage.
     * @throws \Catho\Exception\EmptyException
     * @throws \Catho\Exception\TypeException
     */
    public function testMultipleSearchCount()
    {
        $json = new Json('vagas.json');
        $jobCollection = new JobCollection($json);
        $search = new Search($jobCollection);
        $search->wage(5500, 7000);
        $search->city('Porto');

        $this->assertEquals(3, $search->getResult()->count());
    }

    /**
     * Test a multiple search, including city, wage and terms
     * @throws \Catho\Exception\EmptyException
     * @throws \Catho\Exception\TypeException
     */
    public function testMultipleSearchCountWithTerm()
    {
        $json = new Json('vagas.json');
        $jobCollection = new JobCollection($json);
        $search = new Search($jobCollection);
        $search->wage(5500, 7000);
        $search->city('Porto');
        $search->term('Coordenador');

        $this->assertEquals(1, $search->getResult()->count());
    }
}