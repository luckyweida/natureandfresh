<?php

$interval = number_format( 100 / 47, 2 );

$str = '';
for ( $i = 1, $il = 12; $i <= $il; $i ++ ) {
	$current = $interval * 3 * $i + (($i - 1) * $interval);
	$currentGap = $current + $interval;
	$str .= "#f4f3ee {$current}%, #FEFBF3 {$current}%,\n";
	if ( $i <= ( $il - 1 ) ) {
		$str .= "#FEFBF3 {$currentGap}%, #f4f3ee {$currentGap}%,\n";
	}
}

file_put_contents( 'text.txt', $str );