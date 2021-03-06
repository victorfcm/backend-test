<?php
/**
 * Created by PhpStorm.
 * User: Victor Martins
 * Date: 08/10/16
 * Time: 17:25
 */

namespace Catho;

use Catho\Exception\RequestException;

/**
 * Class Request
 * This class is used to render the income request, process it than output as a JSON.
 * @package Catho
 */
class Request
{
    /**
     * Parameters that can be accepted by the constructor
     * @type array
     */
    protected $parameters = ['term', 'city', 'wage_min', 'wage_max', 'order'];

    /**
     * Terms to search into Title and Description
     * @type string
     */
    private $term;

    /**
     * Cities that can have a job opportunity
     * @type string
     */
    private $city;

    /**
     * Minimum wage acceptable by te searcher.
     * @type int
     */
    private $wage_min;

    /**
     * Maximum wage acceptable by te searcher.
     * @type int
     */
    private $wage_max;

    /**
     * An ENUM string, that can only be ASC or DSC, otherwise will throw an @RequestException
     * @type string
     */
    private $order;

    /**
     * Request constructor.
     * This function will validate if the incomming information is valid, if not, throws @RequestException
     *
     * @param array $parameters
     * @throws @RequestException
     */
    public function __construct(Array $parameters)
    {
        // CHECK THE PARAMETERS, IF THERE IS ANYTHING WRONG, THROWS @RequestException
        foreach($parameters as $parameter => $value)
        {
            if(!in_array($parameter, $this->parameters))
                throw new RequestException('Wrong parameters, that must be in: '.implode(',', $this->parameters), 400);

            $this->$parameter = $value;
        }

        // VERIFY WAGE LIMITATIONS
        if(isset($this->wage_max) && !isset($this->wage_min))
            throw new RequestException('To have a maximum wage, you must have a minimum wage.', 400);

        // VERIFY THE ORDER ENUM
        if(isset($this->order) && !in_array($this->order, ['ASC', 'DSC']))
            throw new RequestException('The order optional must be ASC or DSC', 400);
    }

    /**
     * Process the request, this is the main function of the script.
     * It will use the function @filter to search across the .JSON for the parameters passed by GET method.
     *
     * The parameter @output set if the function will display automatically the JSON output, or if will
     * return a @Result object.
     *
     * @param $output boolean
     * @return \Catho\Result
     */
    public function process($output = true)
    {
        // LOAD THE JSON AND PUT IT INTO A @JobCollection OF MANY @Job
        $json = new Json('vagas.json');
        $jobCollection = new JobCollection($json);

        // SEARCH USING THE @filter FUNCTION, THEN GET THE RESULT
        $search = $this->filter($jobCollection);
        $result = $search->getResult();

        // SET THE OUTPUT ORDER
        switch($this->order)
        {
            default:
            case 'ASC':
                $result->ascending();
                break;

            case 'DSC':
                $result->descending();
                break;
        }

        // CALL THE OUTPUT IN JSON OR RETURN THE RESULT OBJECT
        if($output)
            $result->result();
        else
            return $result;
    }

    /**
     * This function takes a @JobCollection and filter the results using the parameters
     * that was set on the constructor.
     *
     * @param $jobCollection JobCollection
     *
     * @return \Catho\Search
     * @throws \Catho\Exception\EmptyException
     * @throws \Catho\Exception\TypeException
     */
    private function filter(JobCollection $jobCollection)
    {
        // CREATES A NEW SEARCH
        $search = new Search($jobCollection);

        // VERIFY ALL THE PARAMETERS TO SEARCH FOR A FILTER
        // AND THEN, APPLY IT TO THE @JobCollection
        if(isset($this->city))
        {
            $search->city($this->city);
        }

        if(isset($this->term))
        {
            $search->term($this->term);
        }

        if(isset($this->wage_min))
        {
            if(isset($this->wage_max))
            {
                $search->wage($this->wage_min, $this->wage_max);
            }
            else
            {
                $search->wage($this->wage_min);
            }
        }

        return $search;
    }
}