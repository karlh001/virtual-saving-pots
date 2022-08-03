<?php

// Deletes a given transaction


	include("cnx.php");

	$ref = strip_tags($_GET["ref"]);
	$id = strip_tags($_GET["acc"]);
	
	// update
	


	$postP = "
		UPDATE `transactionsT` SET `tran_enabled` = '0' WHERE `transactionsT`.`transID` = '$ref';
		";


			if ($conn->query($postP) === TRUE) {
			
						echo "<script>
				window.location.href = '../trans.php?msg=delete-acc&ref=" . $id . "'
				</script>
				";
			
			
			// Rebuild account list
			$_SESSION["account_rebuild_cache"] = 0;
			
			exit();
			}

			echo "<script>
				window.location.href = '../trans.php?msg=error-acc&ref=" . $id . "'
				</script>
				";

	
	
	

?>
