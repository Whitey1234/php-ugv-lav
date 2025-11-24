<?php

$numbers = array(2, 4, 6, 8, 10);

// 1. Print first element
echo "First element: " . $numbers[0] . "<br>";

// 2. Print last element
echo "Last element: " . end($numbers) . "<br>";

// 3. Add new element 12
$numbers[] = 12;
echo "Array after adding 12: ";
print_r($numbers);
echo "<br>";

// 4. Sum of elements
$sum = array_sum($numbers);
echo "Sum of all elements: " . $sum;

?>
