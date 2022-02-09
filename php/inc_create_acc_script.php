<?php

include("cnx.php");

// Script to add new account to the db


	$accName = strip_tags($_POST["accName"]);
	$accComment = strip_tags($_POST["accComment"]);
	
	
// Add to db

	
	if ( $accName == "" ) {
		echo "You did not give the account a name";
		exit();
	}
	
	
	
	# Include string generator function
	
	
	include("random-string.php");

	$code = rand_string( 10 );
	
	mysqli_next_result($conn);
	
	$insertAcc = "
	INSERT INTO `accountsT` (`acc_ref`, `acc_name`, `acc_comment`, `acc_enabled`)
	VALUES ('$code', '$accName', '$accComment', '1')";

	$result = mysqli_query($conn,$insertAcc) or die ("Error: could not write to db " . mysqli_error($conn));

		# Done, confirms:

		//header("location:accounts.php?msg=success");
		echo "1";

?>
