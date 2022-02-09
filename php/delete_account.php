<?php

	// Deletes a given transaction

	$ref = strip_tags($_GET["ref"]);
	$confirm = strip_tags($_GET["confirm"]);
	
	// update
	
	// Check if confirm
	If ( $confirm == "yes" ) { 
	
		include("../header.php");
		
			echo "
			
			<div class='alert alert-danger'>
			  <strong>Warning!</strong> Do you want to delete this account?<br>
			  You will lose the balance and all transactions<br><br>
			  
			  <a href='../trans.php?ref=$ref' class='btn btn-success' role='button'>No</a>
			  <a href='delete_account.php?ref=$ref' class='btn btn-danger' role='button'>Yes</a>
			  
			</div>
			
		";
		
		include("../footer.php");
		
		exit();
	
	}

	// Connect

	include("cnx.php");

	$postP = "
		UPDATE `accountsT` SET `acc_enabled` = '0' WHERE `accountsT`.`acc_ref` = '$ref';
		
		";



			if ($conn->query($postP) === TRUE) {
			
						echo "<script>
				window.location.href = '../accounts.php?msg=delete'
				</script>
				";
			
			} else {
				

				
			echo "<script>
				window.location.href = '../accounts.php?msg=error&ref=" . $id . "&at=posting'
				</script>
				";
			}


?>
