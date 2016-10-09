<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 17:25
 */

namespace Catho;

/**
 * Class Job
 * @package Catho
 */
class JobCollection
{
    /**
     * The list of the jobs
     * @type array Catho\Job
     */
    public $collection;

    /**
     * JobCollection constructor.
     * This class takes the JSON and adapt it to the @Job class.
     *
     * @param \Catho\Json $json
     */
    public function __construct(Json $json)
    {
        foreach($json->jsonObject->docs as $id => $job)
        {
            $jobObject = new Job();
            $jobObject->id = $id + 1;
            $jobObject->title = $job->title;
            $jobObject->description = $job->description;
            $jobObject->wage = $job->salario;
            $jobObject->cities = $job->cidade;

            $this->collection[$id + 1] = $jobObject;
        }
    }

    /**
     * Return the @Job of this $id
     * @param $id
     *
     * @return \Catho\Job
     */
    public function getById($id)
    {
        return $this->collection[$id];
    }
}