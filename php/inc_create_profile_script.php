<?php
error_reporting(0);
include("cnx.php");

session_start();

// Script to add new account to the db


	$accName = strip_tags($_POST["profileName"]);
	$accComment = strip_tags($_POST["profileDesc"]);
	
	
// Add to db

	
	if ( $accName == "" ) {
		echo "You did not give the profile a name";
		exit();
	}
	

	
	mysqli_next_result($conn);
	
	$insertAcc = "
	INSERT INTO `profileT` (`profile_name`, `profile_description`, `profile_active`, `profile_created`)
	VALUES ('$accName', '$accComment', '1', CURRENT_TIMESTAMP);
	";

	$result = mysqli_query($conn,$insertAcc) or die ("Error: could not write to db " . mysqli_error($conn));
		
		$_SESSION["profile_rebuild_cache"] = 0;

		# Done, confirms:
		echo "1";

?>
