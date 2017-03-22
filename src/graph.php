<?php
/**
 * Graph
 * User: lethanhhung@gmail.com
 * Date: 3/22/2017
 * Time: 5:45 AM
 */

class Graph
{
    protected $vertices;

    protected $edges;

    protected $directed;

    protected $start;

    protected $end;

    protected $path;

    protected $sum;

    protected $backwardSearch;

    protected $maxTime;

    protected $stopValue;

    /**
     * @return mixed
     */
    public function getBackwardSearch()
    {
        return $this->backwardSearch;
    }

    /**
     * @param mixed $backwardSearch
     */
    public function setBackwardSearch($backwardSearch)
    {
        $this->backwardSearch = $backwardSearch;
    }


    /**
     * @return mixed
     */
    public function getVertices()
    {
        return $this->vertices;
    }

    /**
     * @param mixed $vertices
     */
    public function setVertices($vertices)
    {
        $this->vertices = $vertices;
    }

    /**
     * @return array
     */
    public function getEdges()
    {
        return $this->edges;
    }

    /**
     * @param array $edges
     */
    public function setEdges($edges)
    {
        $this->edges = $edges;
    }

    /**
     * @return bool
     */
    public function isDirected()
    {
        return $this->directed;
    }

    /**
     * @param bool $directed
     */
    public function setDirected($directed)
    {
        $this->directed = $directed;
    }

    /**
     * @return int
     */
    public function getStopValue()
    {
        return $this->stopValue;
    }

    /**
     * @param int $stopValue
     */
    public function setStopValue($stopValue)
    {
        $this->stopValue = $stopValue;
    }

    /**
     * @return mixed
     */
    public function getMaxTime()
    {
        return $this->maxTime;
    }

    /**
     * @param mixed $maxTime
     */
    public function setMaxTime($maxTime)
    {
        $this->maxTime = $maxTime;
    }

    /**
     * @return mixed
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * @param mixed $sum
     */
    public function setSum($sum)
    {
        $this->sum = $sum;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     */
    public function setStart($start)
    {
        $this->start = $start;
    }

    /**
     * @return mixed
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @param mixed $end
     */
    public function setEnd($end)
    {
        $this->end = $end;
    }

    /**
     * @param $node
     * @param string $seperator
     */
    public function appendPath($node, $seperator = " => ")
    {
        $this->path .= $seperator . $node;
    }

    /**
     * Reset flags for running a new search
     */
    public function resetPath()
    {
        $this->path = "";
        $this->sum = 0;
        $this->stopValue = 0;
    }

    /**
     * Graph constructor.
     * @param array $vertexes
     * @param array $edges
     * @param bool $directed
     */
    public function __construct($vertexes = array(), $edges = array(), $directed = true)
    {
        $this->vertexes = $vertexes;
        $this->edges = $edges;
        $this->directed = $directed;
        $this->path = "";
        $this->sum = 0;
        $this->stopValue = 0;
    }

    /**
     * @param $from
     * @param $to
     * @param int $latency
     * @param bool $directed
     */
    public function addEdge($from, $to, $latency = 0, $directed = true)
    {
        if (!isset($this->edges[$from]))
        {
            $this->edges[$from] = array();
        }

        $edgeTo = array("to" => $to, "latency" => $latency);
        array_push($this->edges[$from], $edgeTo);

        // if this is undirected , add reverse direct $to , $from
        if (!$directed)
        {
            $this->addEdge($to, $from, $latency, true);
        }
    }

    /**
     * Depth First Search with constraints
     * @param string $start
     * @param array $visited
     */
    public function depthFirstSearch($start = "", $visited = array())
    {
        if($this->getStopValue() > 0)
        {
            return;
        }

        if (empty($start))
        {
            $start = $this->getStart();
        }

        $visited[$start] = true;
        $currentNode = $this->vertices[$start];

        if (!isset($this->edges[$start]))
        {
            return;
        }

        $edges = $this->edges[$start];
        foreach ($edges as $edge) {
            if (!isset($visited[$edge["to"]]))
            {
                $sum = $this->getSum();
                $sum += $edge["latency"];
                $this->setSum($sum);

                $this->appendPath($edge["to"]);

                if  ($edge["to"] == $this->getEnd())
                {
                    $this->appendPath("[=]" . $sum, "");
                    $this->appendPath("|", "");
                    if ($sum <= $this->getMaxTime()) {
                        $this->setStopValue($sum);
                        break;
                    }

                    $sum = 0;
                    $this->setSum($sum);
                    break;
                }

                $this->depthFirstSearch($edge["to"], $visited);
            }
        }
    }

    /**
     *  display network paths
     */
    public function networkPath()
    {
        echo str_repeat("-", 50);
        echo PHP_EOL;
        printf("Input: %s %s %d %s", $this->getStart(), $this->getEnd(), $this->getMaxTime(), PHP_EOL);

        // call search
        $this->depthFirstSearch();
        $result = $this->getPath();


        if ($this->getStopValue() <= 0)
        {
            // not found any paths , Retry  1 more time by searching backward
            $start = $this->getStart();
            $end = $this->getEnd();
            $this->resetPath();
            $this->setStart($end);
            $this->setEnd($start);
            // call search
            $this->depthFirstSearch();

            if ($this->getStopValue() <= 0) {
                // not founds any paths, so stop searching
                echo "Path not found" . PHP_EOL;
                return;
            }
            else
            {
                // found paths by searching backward
                // flag this is a backward search for formatting display later
                $this->setBackwardSearch(true);
                //display result
                $this->displaySearch();;
            }
        } else {
            $this->displaySearch();
        }
    }

    /**
     * Display search result
     */
    public function displaySearch()
    {
        $result = $this->getPath();
        // Format paths
        $pathList = explode("|", $result);
        // remove last empty path
        array_pop($pathList);
        echo "Output: ";

        // Show path immediately if only 1 path
        if(count($pathList) == 1 && !$this->getBackwardSearch())
        {
            echo $this->getStart() .  str_replace("[=]", " => ", $pathList[0]) . PHP_EOL;
        }
        else
        {
            // there are many paths from source to destination, so we find the nearest to max latency time
            $sortedPath = array();

            // build new path list
            foreach ($pathList as $path)
            {
                $pathTime = explode("[=]", $path);
                $key = $this->getStart() . $pathTime[0];
                $value = $pathTime[1];
                $sortedPath[$key] = $value;
            }

            // sort path list by total times, high to low
            arsort ($sortedPath);
            // display nearest path compare with max latency time
            foreach ($sortedPath as $path => $time)
            {
                if($time <= $this->getMaxTime())
                {
                    // if this is backward search, reformat path
                    if ($this->getBackwardSearch())
                    {
                        $reversePath = explode(" => ", $path);
                        // display reverse paths
                        $reversePath = array_reverse($reversePath);
                        $reversePath = implode(' => ', $reversePath);
                        echo $reversePath . " => " . $time . PHP_EOL;
                    }
                    else
                    {
                        // display path
                        echo $path . " => " . $time . PHP_EOL;
                    }
                    // break foreach
                    break;
                }
            }
        }
        // clear path list for new search;
        $this->resetPath();
    }
}