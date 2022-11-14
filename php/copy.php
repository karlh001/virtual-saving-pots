<?php

	session_start();
	include("cnx.php");

	$ID = strip_tags($_GET["id"]);
	$Ref = strip_tags($_GET["ref"]);
	
	
	$today = date("Y-m-d");

	// Look up transaction
	$sql = "
			SELECT * FROM accountsT
			LEFT JOIN transactionsT
			ON transactionsT.trans_accountID = accountsT.accountID
			WHERE tran_enabled > 0
			AND transID = '$ID'
			";

			$result = $conn->query($sql);
	
			if ($result->num_rows > 0) {
					
					
					 while($row = $result->fetch_assoc()) {
								
						$id = $row["accountID"];
						$comment = $row["tran_comment"];
						$amount = $row["tran_amount"];
						
					 }
						
								
			} else {
				
				echo "Oops that did not work";
				exit();
			}
	

	// Post new transaction

	$postP = "
		
		INSERT INTO `transactionsT` (`transID`, `trans_accountID`, `tran_date`, `tran_comment`, `tran_amount`, `tran_enabled`)
		VALUES (NULL, '$id', '$today', '$comment', '$amount', '1'); 
		
		";



			if ($conn->query($postP) === TRUE) {
				
				// Request account list rebuild
				$_SESSION["account_rebuild_cache"] = 0;
			
				echo "<script>
				window.location.href = '../trans.php?msg=done-copy&ref=" . $Ref . "'
				</script>
				";
			
			} else {
				
	
				echo "Error could not save note";
				
			}

?>
