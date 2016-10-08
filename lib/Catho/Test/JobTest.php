<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 18:10
 */

namespace Catho\Test;

require 'lib/autoload.php';

use Catho\Job;
use Catho\Json;
use Catho\JobCollection;
use PHPUnit_Framework_TestCase as PHPUnit;

class JobTest extends PHPUnit
{
    private $json;

    public function testType()
    {
        $this->json = new Json('vagas.json');
        $jobObject = new JobCollection($this->json);

        $this->assertNotEmpty($jobObject->getById(1200));
    }

    public function testId()
    {
        $this->json = new Json('vagas.json');
        $jobObject = new JobCollection($this->json);

        $this->assertEquals(1, $jobObject->getById(1)->id);
    }

    public function testTitle()
    {
        $this->json = new Json('vagas.json');
        $jobObject = new JobCollection($this->json);

        $this->assertEquals('Analista de Suporte de TI', $jobObject->getById(1)->title);
    }

    public function testDescription()
    {
        $this->json = new Json('vagas.json');
        $jobObject = new JobCollection($this->json);

        $this->assertEquals('<li> Prestar atendimento remoto e presencial a clientes. Atuar com suporte de TI.</li><li> Conhecimento aprofundado em Linux Server (IPTables, proxy, mail, samba) e Windows Server(MS-AD, WTS, compartilhamentos).</li>', $jobObject->getById(1)->description);
    }

    public function testWage()
    {
        $this->json = new Json('vagas.json');
        $jobObject = new JobCollection($this->json);

        $this->assertEquals(3200, $jobObject->getById(1)->wage);
    }

    public function testCities()
    {
        $this->json = new Json('vagas.json');
        $jobObject = new JobCollection($this->json);

        $this->assertEquals(['Joinville'], $jobObject->getById(1)->cities);
    }
}