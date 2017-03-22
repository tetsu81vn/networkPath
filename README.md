# Network Path Test

Imagine that there is a small network with a number of interconnected devices. Each connection has a latency parameter which is expressed in milliseconds. Your task is to write a program that will determine whether a signal can travel between two devices in a given amount of time or less.

## Implementation Guidelines:
* The program should be executable from command line and accept one parameter - csv file path.
* CSV file structure:
  * Format: Device From, Device To, Latency (milliseconds) 
  * Contents: 
  ```bash
        A,B,10
        A,C,20 
        B,D,100 
        C,D,30 
        D,E,10 
        E,F,1000 
  ```        
  * Interpretation:
      A connects to B and it takes 10 milliseconds for signal to travel between two devices. A to C and it takes 20 milliseconds, B to D and it takes 100 milliseconds etc.
* The program should then continually wait for user input. Format should be [Device From] [Device To] [Time] (e.g A F 1000 followed by ENTER key). If the signal can travel from A to F in 1000ms or less then output the signal path and total travel time in milliseconds otherwise print "Path not found". If user enters QUIT then terminate the program.
* You are only required to output first path that meets the time constraint. It does not have to be the shortest path.

## Hints:
Think of the best data structure to accommodate devices and connections and write your code accordingly.

## Implementation Guidelines:

Please commit all your code to a Github public repository and send us the URL. We would like to see your commit history and instructions on how to run the program from command line.

## Sample Input / Output (based on above CSV data):

```bash
 Input: A F 1000 
 Output: Path not found

 Input: A F 1200 
 Output: A => B => D => E => F => 1120

 Input: A D 100 
 Output: A => C => D => 50

 Input: E A 400 
 Output: E => D => B => A => 120

 Input: E A 80
 Output: E => D => C => A => 60
``` 

## Requirement: php version >= 5.5

## How to use:

Move to working folder (folder where contain main.php file), type this command in terminal / command line :
```bash
  php main.php pathToFileCSV
```

Example: 
```bash
  php main.php ./data/data.csv
```

## How to edit code and test:

 You can edit ./test/graphTest.php to add data by hand insted of loading from csv file. After editing, you can run test :
 
 ```bash
  php ./test/graphTest.php
```

