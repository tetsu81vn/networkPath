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