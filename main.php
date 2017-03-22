<?php

// Main program
require_once(dirname(__FILE__).'/src/graph.php');

    echo str_repeat("-", 50);
    echo PHP_EOL;
    // load csv from file
    if (!isset($argv[1]))
    {
        echo "Please pass file path to program. (e.g php main.php ./data.csv followed by ENTER key)" . PHP_EOL;
        exit;
    }

    $filename = $argv[1];

    if (!file_exists($filename)) {
        echo "File is not existed!";
        exit;
    }

    $csv = array_map('str_getcsv', file($filename));
    array_walk($csv, function(&$a) use ($csv) {
        $a = array_combine($csv[0], $a);
    });
    // Remove header
    array_shift($csv);

    $fromVertices = array_column($csv, 'from');
    $toVertices = array_column($csv, 'to');

    // All vertices
    $vertices = array_values(array_unique(array_merge($fromVertices,$toVertices)));

    $graph = new Graph($vertices);
    //$graph->addEdge("A","B",10);
    foreach($csv as $line)
    {
        $graph->addEdge($line['from'],$line['to'],$line['latency']);
    }

    $handle = null;
    echo "PLease input data." . PHP_EOL;
    echo "Format should be [Device From] [Device To] [Time] (e.g A F 1000 followed by ENTER key)" . PHP_EOL;
    echo "Type quit to exit (e.quit followed by ENTER key)" . PHP_EOL;
    do
    {
        echo str_repeat("-", 50);
        echo PHP_EOL;
        echo "Input:";
        $handle = fopen ("php://stdin","r");
        $line = fgets($handle);

        $line = trim(strtoupper($line));

        if ($line == "QUIT")
        {
            break;
        }

        $input = explode(' ', $line);


        if(count($input) != 3)
        {
            echo "Wrong format !";
        }
        else if (isset($input[2]) && !is_numeric($input[2]))
        {
            echo "Wrong format ! Please input latency is a number";
        }
        else
        {
            $graph->setStart($input[0]);
            $graph->setEnd($input[1]);
            $graph->setMaxTime($input[2]);
            $graph->networkPath();
        }
    } while ($line != "QUIT");


    fclose($handle);
    echo str_repeat("-", 50);
    echo PHP_EOL;
    echo "Thank you..." . PHP_EOL;


