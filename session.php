<?php
session_start();

print_r($_SESSION);

echo "<br>";

echo time()+1800;


echo "<br>";

echo time();

// Unset

if ( $_GET["delete"] == "y" ) {
	session_destroy();
}


?>