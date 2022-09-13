<?php

	//session_start();
	
	// Deletes a given transaction

	$ref = strip_tags($_GET["ref"]);
	$confirm = strip_tags($_GET["confirm"]);
	
	// update
	
	// Check if confirm
	If ( $confirm == "yes" ) { 
	
		include("../header.php");
		
			echo "
			
			<div class='alert alert-danger'>
			  <strong>Warning!</strong> Do you want to delete this profile?<br>
			  You will lose the accounts and their transactions<br><br>
			  
			  <a href='../profiles.php' class='btn btn-success' role='button'>No</a>
			  <a href='delete_profile.php?ref=$ref' class='btn btn-danger' role='button'>Yes</a>
			  
			</div>
			
		";
		
		include("../footer.php");
		
		exit();
	
	}

	// Connect

	include("cnx.php");

	$postP = "
		UPDATE `profileT` SET `profile_active` = '0' WHERE `profile_ID` = '$ref';
		
		";



			if ($conn->query($postP) === TRUE) {
				
				
				// Delete account from JSON cache
				unset($_SESSION['AccountID_' . $ref]);
				unset($_SESSION['AccountBalance_' . $ref]);
				$_SESSION["profile_rebuild_cache"] = 0;
			
			echo "<script>
				window.location.href = '../profiles.php?msg=delete'
				</script>
				";
			
			} else {
				

				
			echo "<script>
				window.location.href = '../profiles.php?msg=error&ref=" . $id . "&at=posting'
				</script>
				";
			}

		

?>
