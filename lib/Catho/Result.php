<?php
/**
 * Created by PhpStorm.
 * User: dev01
 * Date: 08/10/16
 * Time: 18:53
 */

namespace Catho;


class Result
{
    /**
     * @type array
     */
    private $resultCollection;

    public function add(Job $job)
    {
        $this->resultCollection[] = $job;
    }

    public function result()
    {
        header('Content: application/json');
        echo json_encode(['status' => 'success', 'code' => 200, 'count' => $this->count(), 'result' => $this->resultCollection]);
        exit();
    }

    public function count()
    {
        return count($this->resultCollection);
    }

    public function ascending()
    {
        usort($this->resultCollection, [$this, 'sortAsc']);
    }

    public function descending()
    {
        usort($this->resultCollection, [$this, 'sortDsc']);
    }

    private function sortAsc($a, $b)
    {
        if($a === $b)
            return 0;

        return($a > $b)?+1:-1;
    }

    private function sortDsc($a, $b)
    {
        if($a === $b)
            return 0;

        return($a < $b)?+1:-1;
    }
}