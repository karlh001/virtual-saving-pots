<?php




$conn = NEW mysqli("localhost", "karl", "password1", "budget_app");

// Check connection
if ($conn->connect_error) { // if there is a connection error
    die("Oops ... Connection failed: " . $conn->connect_error);
}
//echo "<!--Connected successfully -->"; // let's me know whether this was successful in comments



?>
