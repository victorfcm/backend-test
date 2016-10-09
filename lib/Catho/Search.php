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

/**
 * Class Search
 * This class will filter the @JobCollection passed by parameter, and will return a @Result object.
 * @package Catho
 */
class Search
{
    /**
     * Hold the actual @JobCollection during the filter action
     * @type \Catho\JobCollection
     */
    private $jobCollection;

    /**
     * Search constructor.
     *
     * @param \Catho\JobCollection $jobCollection
     */
    public function __construct(JobCollection $jobCollection)
    {
        $this->jobCollection = $jobCollection->collection;
    }

    /**
     * This function is used to search in the Title and Description parameters. And will search
     * for everything on the string.
     *
     * @param $stringToSearch
     *
     * @throws \Catho\Exception\EmptyException
     * @throws \Catho\Exception\TypeException
     */
    public function term($stringToSearch)
    {
        if(!is_string($stringToSearch))
            throw new TypeException('Search term must be an string', 500);

        $this->search(['title', 'description'], $stringToSearch);
    }

    /**
     * This function will search on the City field. And the search don't need to be precise, partial
     * string matches.
     *
     * @param $stringToSearch
     *
     * @throws \Catho\Exception\EmptyException
     * @throws \Catho\Exception\TypeException
     */
    public function city($stringToSearch)
    {
        if(!is_string($stringToSearch))
            throw new TypeException('Search term must be an string', 500);

        $this->search(['cities'], $stringToSearch);
    }

    /**
     * This function will select the Jobs between the range passed by parameter.
     *
     * @param      $min
     * @param null $max
     *
     * @throws \Catho\Exception\EmptyException
     * @throws \Catho\Exception\TypeException
     */
    public function wage($min, $max = null)
    {
        // CHECK IF THE MAXIMUM VALUE IS BIGGER THAN THE MINIMUM VALUE
        if(isset($max) && $min > $max)
            throw new TypeException('The minimum wage cannot be bigger than the maximum', 403);

        // THIS RESULT WILL NOT BE THE FINAL RESULT, IT'S HERE ONLY TO CHECK IF THERE IS ANYTHING TO SHOW
        // ON THE FINAL RESULT
        $result = new Result;

        foreach($this->jobCollection as $k => $job)
        {
            // VERIFY IF THE @Job WAGE IS BETWEEN THE RANGE $min AND $max
            if((null !== $max && $job->wage >= $min && $job->wage <= $max) || (null === $max && $job->wage >= $min))
            {
                // IF TRUE, ADD IT TO THE RESULT AND CONTINUE
                $result->add($job);
                continue;
            }

            // IF NOT, REMOVE THE ENTRY FRON THE @jobCollection
            // IN THIS WAY, IT'S POSSIBLE TO USE MULTIPLE SEARCH METHODS IN THE SAME QUERY
            unset($this->jobCollection[$k]);
        }

        // IF THERE IS NO RESULT, THROW 404
        if($result->count() < 1)
            throw new EmptyException('No result was found', 404);
    }

    /**
     * This function will process the search in the parameters, the $fields argument is the field of this
     * class that will be filtered by this specific $stringToSearch.
     *
     * @param array $fields
     * @param       $stringToSearch
     *
     * @throws \Catho\Exception\EmptyException
     */
    private function search(Array $fields, $stringToSearch)
    {
        // THIS RESULT WILL NOT BE THE FINAL RESULT, IT'S HERE ONLY TO CHECK IF THERE IS ANYTHING TO SHOW
        // ON THE FINAL RESULT
        $result = new Result;

        foreach($this->jobCollection as $k => $job)
        {
            // STORAGE THE INITIAL RESULT COUNT
            $resultsCount = $result->count();

            foreach($fields as $field)
            {
                // CHECK IF THE FIELD IS AN STRING TYPE.
                if(is_string($job->$field))
                {
                    // IF YES, TRY TO FIND THE $stringToSearch ON THE FIELD
                    if(strpos(strtolower($job->$field), strtolower($stringToSearch)) !== false)
                    {
                        // THEN, ADD IT TO THE RESULT AND CONTINUE THE PROCESS
                        $result->add($job);
                        continue;
                    }
                }
                // IF NOT, CHECK IF THE FIELD IS A ARRAY
                elseif(is_array($job->$field))
                {
                    // IF TRUE, ITERATE INSIDE THE FIELDS TO FIND THE $stringToSearch IN SOME ELEMENT
                    foreach($job->$field as $subField)
                    {
                        if(strpos(strtolower($subField), strtolower($stringToSearch)) !== false)
                        {
                            // THEN ADD IT TO THE RESULT AND CONTINUE THE PROCESS
                            $result->add($job);
                            continue;
                        }
                    }
                }
            }

            // IF THE RESULT COUNT IT'S NOT CHANGED, REMOVE THIS LINE FRON THE @JobCollection
            // IN THIS WAY, IT'S POSSIBLE TO USE MULTIPLE SEARCH METHODS IN THE SAME QUERY
            if($result->count() === $resultsCount)
                unset($this->jobCollection[$k]);
        }

        // IF THERE IS NO RESULT, THROW 404
        if($result->count() < 1)
            throw new EmptyException('No result was found', 404);
    }

    /**
     * Foreach @Job remaining on the @JobCollection after the @Search class clean it up,
     * it will be added to the final result.
     * @return \Catho\Result
     */
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