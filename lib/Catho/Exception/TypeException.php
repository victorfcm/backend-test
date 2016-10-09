<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 17:29
 */

namespace Catho\Exception;

class TypeException extends \Exception
{

    /**
     * FileException constructor.
     * Throw an exception as a JSON Output
     *
     * @param string                          $message
     * @param int                             $code
     * @param \Exception                      $previous
     */
    public function __construct($message, $code, \Exception $previous = null)
    {
        echo json_encode(['status' => 'error', 'message' => $message, 'code' => $code]);
        exit;
    }
}