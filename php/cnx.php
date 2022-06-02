<?php



### What's the database name?
$Base_DName = "budget_app";

### What's the username for the database?
$Base_UName = "karl";

### And the password?
$Base_PWord = "password1";

### What about the location of your database?
### If you are hosting the database on the same computer/server.,
### it is likely you do not need to change
$Base_Host = "localhost";




## Do no edit below this line ##


$conn = NEW mysqli($Base_Host, $Base_UName, $Base_PWord, $Base_DName);



// Check connection
if ($conn->connect_error) { // if there is a connection error
    die("Oops ... Connection failed: " . $conn->connect_error);
}



?>
