<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 17:25
 */

namespace Catho;


use Catho\Exception\EmptyException;
use Catho\Exception\TypeException;

class Search
{
    /**
     * @type \Catho\JobCollection
     */
    private $jobCollection;
    private $stringToSearch;

    public function __construct(JobCollection $jobCollection)
    {
        $this->jobCollection = $jobCollection->collection;
    }

    public function term($stringToSearch)
    {
        if(!is_string($stringToSearch))
            throw new TypeException('Search term must be an string', 500);

        return $this->search(['title', 'description'], $stringToSearch);
    }

    public function city($stringToSearch)
    {
        if(!is_string($stringToSearch))
            throw new TypeException('Search term must be an string', 500);

        return $this->search(['cities'], $stringToSearch);
    }

    public function wage($min, $max = null)
    {
        if(isset($max) && $min > $max)
            throw new TypeException('The minimum wage cannot be bigger than the maximum', 403);

        $result = new Result;

        foreach($this->jobCollection as $k => $job)
        {
            if((null !== $max && $job->wage >= $min && $job->wage <= $max) || (null === $max && $job->wage >= $min))
            {
                $result->add($job);
                continue;
            }

            unset($this->jobCollection[$k]);
        }

        if($result->count() < 1)
            throw new EmptyException('No result was found', 404);
    }

    private function search(Array $fields, $stringToSearch)
    {
        $result = new Result;

        foreach($this->jobCollection as $k => $job)
        {
            $resultsCount = $result->count();
            foreach($fields as $field)
            {
                if(is_string($job->$field))
                {
                    if(strpos($job->$field, $stringToSearch) !== false)
                    {
                        $result->add($job);
                        continue;
                    }
                }
                elseif(is_array($job->$field))
                {
                    foreach($job->$field as $subField)
                    {
                        if(strpos($subField, $stringToSearch) !== false)
                        {
                            $result->add($job);
                            continue;
                        }
                    }
                }
            }

            if($result->count() === $resultsCount)
                unset($this->jobCollection[$k]);
        }

        if($result->count() < 1)
            throw new EmptyException('No result was found', 404);
    }

    public function getResult()
    {
        $result = new Result;

        foreach($this->jobCollection as $job)
        {
            $result->add($job);
        }

        return $result;
    }
}