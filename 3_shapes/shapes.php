<?php 

/* 
Shapes generator

USAGE

shapes.php test - for demostrating working on files and check squares computation.

Don't pass argument to script for generating 16 figures and sorting.

*/

interface Shape
{
    function square();
    function readFromFile($handle);
    function writeToFile($handle);
    
    function dump($prefix = "");
}

class Point
{
    private $x;
    private $y;
    
    function __construct($x = 0, $y = 0) 
    {
        $this->x = (int)($x);
        $this->y = (int)($y);
    }
    
    function x() 
    { 
        return $this->x; 
    }
    
    function y() 
    { 
        return $this->y; 
    }
    
    function str() 
    { 
        return '(x: ' . $this->x . ', y: ' . $this->y . ')'; 
    }
}

// A ----- B
// |       |
// C-------D

class Rectangle implements Shape
{
    private $a = null;
    private $b = null;
    private $c = null;
    private $d = null;
    
    function __construct($a, $b, $c, $d)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->d = $d;
    }
    
    function square() 
    {
        $width  = sqrt(pow($this->a->x() - $this->b->x(), 2) + pow($this->a->y() - $this->b->y(), 2));
        $height = sqrt(pow($this->a->x() - $this->c->x(), 2) + pow($this->a->y() - $this->c->y(), 2));
        
        return $width * $height;
    }
    
    function readFromFile($handle)
    {
        $line = fgets($handle, 1024);
        $arr = explode(" ", $line);
        $a = new Point($arr[0], $arr[1]);
        
        $line = fgets($handle, 1024);
        $arr = explode(" ", $line);
        $b = new Point($arr[0], $arr[1]);
        
        $line = fgets($handle, 1024);
        $arr = explode(" ", $line);
        $c = new Point($arr[0], $arr[1]);
        
        $line = fgets($handle, 1024);
        $arr = explode(" ", $line);
        $d = new Point($arr[0], $arr[1]);
    }
    
    function writeToFile($handle)
    {
        fwrite($handle, $this->a->x() . " " . $this->a->y() . PHP_EOL);
        fwrite($handle, $this->b->x() . " " . $this->b->y() . PHP_EOL);
        fwrite($handle, $this->c->x() . " " . $this->c->y() . PHP_EOL);
        fwrite($handle, $this->d->x() . " " . $this->d->y() . PHP_EOL);
    }
    
    function dump($prefix = null)
    {
        if (!$prefix)
            $prefix = "Rectangle: ";
        echo $prefix .' A='. $this->a->str() .", B=". $this->b->str() .", C=". $this->c->str() .", D=". $this->d->str() 
            . ", Square=". $this->square() . PHP_EOL;
    }
}


class Circle implements Shape
{
    private $center = null;
    private $radius = null;

    function __construct($center, $radius) 
    {
        $this->center = $center;
        $this->radius = $radius;
    }
    
    function square() 
    {
        return M_PI * pow($this->radius, 2);
    }
    
    function readFromFile($handle)
    {
        $line = fgets($handle, 1024);
        $arr = explode(" ", $line);
        $this->center = new Point($arr[0], $arr[1]);
        $this->radius = $arr[2];
    }
    
    function writeToFile($handle)
    {
        fwrite($handle, $this->center->x() . " " . $this->center->y() . " " . $this->radius);
    }
    
    function dump($prefix = null)
    {
        if (!$prefix)
            $prefix = "Circle: ";
        echo $prefix .' Center='. $this->center->str() .", Radius=". $this->radius .", Square=". $this->square() .PHP_EOL;
    }
}

//    A
//   / \
//  B---C

class Triangle implements Shape
{
    private $a = null;
    private $b = null;
    private $c = null;

    function __construct($a, $b, $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }
    
    function square() 
    {   
        $s = 0.5 * (
            ($this->a->x() - $this->c->x()) * ($this->b->y() - $this->c->y()) 
            -
            ($this->b->x() - $this->c->x()) * ($this->a->y() - $this->c->y()) 
        );
        
        return abs($s);
    }
    
    function readFromFile($handle)
    {
        $line = fgets($handle, 1024);
        $arr = explode(" ", $line);
        $this->a = new Point($arr[0], $arr[1]);
        
        $line = fgets($handle, 1024);
        $arr = explode(" ", $line);
        $this->b = new Point($arr[0], $arr[1]);
        
        $line = fgets($handle, 1024);
        $arr = explode(" ", $line);
        $this->c = new Point($arr[0], $arr[1]);
    }
    
    function writeToFile($handle)
    {
        fwrite($handle, $this->a->x() . " " . $this->a->y() . PHP_EOL);
        fwrite($handle, $this->b->x() . " " . $this->b->y() . PHP_EOL);
        fwrite($handle, $this->c->x() . " " . $this->c->y() . PHP_EOL);
    }
    
    function dump($prefix = null)
    {
        if (!$prefix)
            $prefix = "Triangle: ";
        echo($prefix .' A='. $this->a->str() .", B=". $this->b->str() .", C=". $this->c->str() 
            .", Square=". $this->square() .PHP_EOL);
    }
}

function randomPoint()
{
    return new Point(rand(0, 200), rand(0, 200)); 
}

function randomRectangle()
{
    $a = randomPoint();
    $width = rand(2, 200);
    $height = rand(1, $width);
    $b = new Point($a->x() + $width, $a->y());
    $c = new Point($a->x(), $a->y() + $height);
    $d = new Point($a->x() + $width, $a->y() + $height);
    
    return new Rectangle($a, $b, $c, $d);
}

function randomCircle()
{
    $center = randomPoint();
    $radius = rand(1, 200);
    
    return new Circle($center, $radius);
}

function randomTriangle()
{
    $a = randomPoint();
    $b = randomPoint();
    $c = randomPoint();
    
    return new Triangle($a, $b, $c);
}

function doWork($shape_count)
{
    $shapes = array();
    
    for($i = 0; $i < 16; ++$i) {
        array_push($shapes, randomRectangle());
        array_push($shapes, randomCircle());
        array_push($shapes, randomTriangle());
    }
    
    usort(
        $shapes,
        function($a, $b)
        {
            return ($a->square() < $b->square()) ? 1 : -1;
        }
    );
    
    echo '<pre>'
    foreach($shapes as $shape) {
        $shape->dump();
    }
    echo '</pre>'
}

function doTest() 
{
    echo '<pre>';
    
    $rectangle_fh = fopen("rectangle.txt", "w") 
        or die("Can't open file: \"rectangle.txt\" for writing");
    
    $rectangle = new Rectangle(new Point(1, 5), new Point(7, 5), new Point(1, 1), new Point(7, 1));
    $rectangle->dump("Rectangle: ");
    $rectangle->writeToFile($rectangle_fh);
    echo "Rectangle writed to file" . PHP_EOL;
    
    fclose($rectangle_fh);
    
    $rectangle_fh = fopen("rectangle.txt", "r") 
        or die("Can't open file: \"rectangle.txt\" for reading");
    $rectangle->readFromFile($rectangle_fh);
    $rectangle->dump("Readed rectangle: ");
    
    fclose($rectangle_fh);
    
    if ($rectangle->square() != 24) {
        echo "FAILED:  Rectangle square is: " . $rectangle->square() . ", expected: 24" . PHP_EOL;
    } else {
        echo "SUCCESS: Rectangle square is: " . $rectangle->square() . ", expected: 24" . PHP_EOL;
    }
    echo(PHP_EOL);
    
    
    $circle_fh = fopen("circle.txt", "w") or die("Can't open file: \"circle.txt\" for writing");
    
    $circle = new Circle(new Point(0, 0), 2);
    $circle->dump("Randomized circle: ");
    $circle->writeToFile($circle_fh);
    echo "Circle writed to file" . PHP_EOL;
    
    fclose($circle_fh);
    
    $circle_fh = fopen("circle.txt", "r") 
        or die("Can't open file: \"circle.txt\" for reading");
    $circle->readFromFile($circle_fh);
    $circle->dump("Readed circle: ");
    
    fclose($circle_fh);
    
    $s = $circle->square();
    if ($s - 12.566370614359172 > 0.00001 && $s - 12.566370614359172 > 0.00001) {
        echo "FAILED:  Circle square is: " . $circle->square() 
            . ", expected: ~ 12.566370614359172" . PHP_EOL;
    } else { 
        echo "SUCCESS: Circle square is: " . $circle->square() 
        . ", expected: ~ 12.566370614359172" . PHP_EOL;
    }
    echo(PHP_EOL);
    
    
    $triangle_fh = fopen("triangle.txt", "w") 
        or die("Can't open file: \"triangle.txt\" for writing");
    
    $triangle = new Triangle(new Point(3, 3), new Point(0, 0), new Point(0, 5));
    $triangle->dump("Randomized triangle: ");
    $triangle->writeToFile($triangle_fh);
    echo "Triangle writed to file" . PHP_EOL;
    
    fclose($triangle_fh);
    
    $triangle_fh = fopen("triangle.txt", "r") 
        or die("Can't open file: \"triangle.txt\" for reading");
    $triangle->readFromFile($triangle_fh);
    $triangle->dump("Readed triangle: ");
    
    fclose($triangle_fh);
    
    $s = $triangle->square();
    if ($s - 7.5 > 0.00001 && $s - 7.5 > 0.00001) {
        echo "FAILED:  Triangle square is: " . $s . ", expected: ~ 7.5" . PHP_EOL;
    } else {
        echo "SUCCESS: Triangle square is: " . $s . ", expected: ~ 7.5" . PHP_EOL;
    }
    
    echo '</pre>';
}

if ($argv[1] == 'test') {
    doTest();
} else {
    doWork();
}

?>
