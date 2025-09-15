<?php
// Prints outs a variable to the screen
function debug( $var )
{
	echo '<div style="text-align:left;background-color:#FFF;color:#000;">';
		echo '<pre>';
		print_r( $var );
		echo '</pre>';
	echo '</div>';
}// End function debug

// Prints out a stack trace
function trace()
{
	$trace = debug_backtrace();
	echo '<div style="background-color:#FFF;color:#000;font-align:left;border:solid 1px #000;">';
	foreach( $trace as $level )
		echo $level['file'] . ': ' . $level['line'] . '<br />';
	echo '</div>';
}// End function trace

// Prints out the file name and line number on which this function was called
function here()
{
	$trace = debug_backtrace();
	$level = array_shift( $trace );
	debug( 'Here: ' . $level['file'] . ': ' . $level['line'] );
}// End function here

// Prints out the line this method was called on and kills the request
function dine() {
    $trace = debug_backtrace();
	$level = array_shift( $trace );
	die( 'dine called at: ' . $level['file'] . ': ' . $level['line'] );
}
?>