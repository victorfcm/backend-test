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
class Job
{
    /**
     * The key on the JSON Object
     * @type int
     */
    public $id;

    /**
     * The title of the JOB on the JSON file
     * @type string
     */
    public $title;

    /**
     * The description of the JOB on the JSON file
     * @type string
     */
    public $description;

    /**
     * The remuneration of the JOB on the JSON file
     * @type float
     */
    public $wage;

    /**
     * The array cities of the JOB on the JSON file
     * @type array
     */
    public $cities;
}