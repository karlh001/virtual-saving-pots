<?php

include("cnx.php");

session_start();

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
	
	
	// Get profile ID
	$profileID = $_SESSION["profileID"];
	
	mysqli_next_result($conn);
	
	$insertAcc = "
	INSERT INTO `accountsT` (`profile_ID`, `acc_ref`, `acc_name`, `acc_comment`, `acc_enabled`)
	VALUES ('$profileID', '$code', '$accName', '$accComment', '1')";

	$result = mysqli_query($conn,$insertAcc) or die ("Error: could not write to db " . mysqli_error($conn));

		# Done, confirms:

		//header("location:accounts.php?msg=success");
		echo "1";

?>
