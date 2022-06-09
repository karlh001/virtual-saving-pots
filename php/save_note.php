<?php

	include("cnx.php");

	$Acc = strip_tags($_POST["Acc"]);
	$Note = strip_tags($_POST["AccNotes"]);
	
	// update note

	$postP = "
		UPDATE `accountsT` SET `acc_notes` = '$Note' WHERE `accountsT`.`accountID` = '$Acc';
		
		";



			if ($conn->query($postP) === TRUE) {
			
				echo "1";
			
			} else {
				
	
				echo "Error could not save note";
				
			}

?>
