<?php

// Deletes a given transaction


	include("cnx.php");

	$ref = strip_tags($_GET["ref"]);
	$id = strip_tags($_GET["acc"]);
	
	// update
	


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
