<?php

require_once(dirname(__FILE__).'/../src/graph.php');

// Main program
$vertices = array("A", "B", "C", "D", "E", "F");
$graph = new Graph($vertices);
$graph->addEdge("A","B",10);
$graph->addEdge("A","C",20);
$graph->addEdge("B","D",100);
$graph->addEdge("C","D",30);
$graph->addEdge("D","E",10);
$graph->addEdge("E","F",1000);

$graph->setStart("A");
$graph->setEnd("F");
$graph->setMaxTime(1000);
$graph->networkPath();

$graph->setStart("A");
$graph->setEnd("F");
$graph->setMaxTime(1200);
$graph->networkPath();

$graph->setStart("A");
$graph->setEnd("D");
$graph->setMaxTime(100);
$graph->networkPath();

$graph->setStart("E");
$graph->setEnd("A");
$graph->setMaxTime(400);
$graph->networkPath();

$graph->setStart("E");
$graph->setEnd("A");
$graph->setMaxTime(80);
$graph->networkPath();