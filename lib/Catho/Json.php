<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 17:26
 */

namespace Catho;

use Catho\Exception\FileException;

/**
 * Class Json
 * @package Catho
 */
class Json
{
    /**
     * @type string
     */
    private $pathToJson;

    /**
     * @type object
     */
    public $jsonObject;

    /**
     * Json constructor.
     */
    public function __construct($path)
    {
        $this->pathToJson = $path;

        // Verify the integrity of the path.
        if(!file_exists($this->pathToJson))
            throw new FileException('The JSON path was not found', 404);

        // Check the permission of the file.
        if(!is_readable($this->pathToJson))
            throw new FileException('The JSON file is not readable', 403);

        // Decode the JSON file into a object
        $this->jsonObject = json_decode(file_get_contents($this->pathToJson));

        // Check the integrity of the object
        if(!$this->jsonObject)
            throw new FileException('The JSON file is invalid', 500);

    }
}