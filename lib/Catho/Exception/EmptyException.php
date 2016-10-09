<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 17:29
 */

namespace Catho\Exception;

/**
 * Class EmptyException.
 * The exception classes are useful to handle the errors, but because
 * of the lack of time, I will not do it. So there are some default Exceptions Class.
 *
 * @package Catho\Exception
 */
class EmptyException extends \Exception
{

    /**
     * EmptyException constructor.
     * Throw an exception as a JSON Output
     *
     * @param string                          $message
     * @param int                             $code
     * @param \Exception                      $previous
     */
    public function __construct($message, $code, \Exception $previous = null)
    {
        echo json_encode(['status' => 'error', 'exceptionType' => 'EmptyException', 'message' => $message, 'code' => $code]);
        exit;
    }
}