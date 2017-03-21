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
}