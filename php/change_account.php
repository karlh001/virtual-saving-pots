<?php

include("cnx.php");

// Script to add new account to the db


	$accName = strip_tags($_POST["name"]);
	$accComment = strip_tags($_POST["desc"]);
	$accRef = strip_tags($_POST["account"]);
	
	
// Add to db

	
	if ( $accName == "" ) {
		echo "You did not give the account a name";
		exit();
	}
	
	
	
	
	mysqli_next_result($conn);
	
	$insertAcc = "
	
	UPDATE `accountsT` SET `acc_name` = '$accName', `acc_comment` = '$accComment' WHERE `accountsT`.`acc_ref` = '$accRef'; 
	";

	$result = mysqli_query($conn,$insertAcc) or die ("Error: could not write to db " . mysqli_error($conn));

		# Done, confirms:

		$_SESSION["account_use_cache"] = 0;
		echo "1";

?>
