<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 18:53
 */

namespace Catho;

/**
 * Class Result.
 * This class is used to group the @JobCollection after the @Search class has filtered it.
 *
 * @package Catho
 */
class Result
{
    /**
     * This is the holder of the @JobCollection
     * @type array
     */
    private $resultCollection;

    /**
     * Adds a new @Job item to the @resultCollection
     * @param \Catho\Job $job
     */
    public function add(Job $job)
    {
        $this->resultCollection[] = $job;
    }

    /**
     * Ouptut the result in a JSON default response.
     */
    public function result()
    {
        header('Content: application/json');
        echo json_encode(['status' => 'success', 'code' => 200, 'count' => $this->count(), 'result' => $this->resultCollection]);
        exit();
    }

    /**
     * Get the actual @resultCollection
     * @return array
     */
    public function getCollection()
    {
        return $this->resultCollection;
    }

    /**
     * Count the quantity of items in the @resultCollection
     * @return int
     */
    public function count()
    {
        return count($this->resultCollection);
    }

    /**
     * Sort the @resultCollection to ascending
     */
    public function ascending()
    {
        usort($this->resultCollection, [$this, 'sortAsc']);
    }

    /**
     * Sort the @resultCollection to descending
     */
    public function descending()
    {
        usort($this->resultCollection, [$this, 'sortDsc']);
    }

    /**
     * USort default function for sorting objects
     * @param $a
     * @param $b
     *
     * @return int
     */
    private function sortAsc($a, $b)
    {
        if($a->wage === $b->wage)
            return 0;

        return($a->wage > $b->wage)?+1:-1;
    }

    /**
     * USort default function for sorting objects
     * @param $a
     * @param $b
     *
     * @return int
     */
    private function sortDsc($a, $b)
    {
        if($a->wage === $b->wage)
            return 0;

        return($a->wage < $b->wage)?+1:-1;
    }
}