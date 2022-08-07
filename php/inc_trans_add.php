<?php
session_start();
error_reporting(0);
include("cnx.php");


// save new transaction to accounts

	$id = strip_tags($_POST["id"]);
	$ref = strip_tags($_POST["ref"]);
	$date = strip_tags($_POST["date"]);
	$comment = strip_tags($_POST["comment"]);
	$amount = strip_tags($_POST["amount"]);
	$addcheck = strip_tags($_POST["addcheck"]);


// destorys arrary
	$error = [];

	if ($date == "")
{

	$error[] = 1;
}

	if ($comment == "")
{

	$error[] = 1;
}

	if ($amount == "")
{

	$error[] = 1;
}

		foreach ($error as $value) { // checks if any errors occured in the form

			if ($value > 0) {

				echo "<script>
				window.location.href = '../trans.php?msg=error&ref=" . $ref . "&at=errorcheck'
					</script>
				";
				exit();
					}
			}


	//
	
	// Remove comma in thounsand seperator
	$amount = str_replace(',', '', $amount);
	
	if ( $addcheck != "1" ) {
		
		// Checks if check box is enabled to add
	
		$amount = "-" . $amount;
		
	}
	


	// Insert into db
	mysqli_next_result($conn);
	$postP = "
	INSERT INTO `transactionsT` (`trans_accountID`, `tran_date`, `tran_comment`, `tran_amount`, `tran_enabled`)
	VALUES ('$id', '$date', '$comment', '$amount', '1');
	";


		if ($conn->query($postP) === TRUE) {
			
		// Request account list rebuild
		$_SESSION["account_rebuild_cache"] = 0;
		
		echo "<script>
			window.location.href = '../trans.php?msg=done&ref=" . $ref . "'
			</script>
			";
			

			
		exit();
		}

		echo "<script>
			window.location.href = '../trans.php?msg=error&ref=" . $ref . "&at=posting'
			</script>
			";

?>
