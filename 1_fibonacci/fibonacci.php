<?php

/*
First 64 elements of Fibonacci series.
*/

const I_MAX = 64;

$a_cur = 1;
$a_prev = 1;

echo "<pre>" . PHP_EOL;
for($i = 1; $i <= I_MAX; ++$i) {
    if ($i > 2) {
        $tmp = $a_cur;
        $a_cur = $a_cur + $a_prev;
        $a_prev = $tmp;
    }
    echo("$i => $a_cur" . PHP_EOL);
}

echo "</pre>";

?>
