<?php

// Gets list of accounts

$sql = "SELECT * from accountsT WHERE acc_enabled > 0 AND profile_ID = $ProfileID";

$result = $conn->query($sql);


        
// Display results


if ($result->num_rows > 0) {
	
	
     while($row = $result->fetch_assoc()) {
		 
		 
		 // Put results into JSON
		
					 
		$AccountIndex[] = $row["acc_ref"]; 
		 
		// Save the account details into a
		// JSON format to cahce and use later
		$accArray = array("ID"=>$row["acc_ref"], "Name"=>$row["acc_name"], "Description"=>$row["acc_comment"]);
		
		// Encode the array and store in a session
		$_SESSION["AccountID_" . $row["acc_ref"]] = json_encode($accArray);	
		
		// Store account ID in index
		$_SESSION["account_index"] = $AccountIndex; 
		 
				
		echo "<tr>
		
			\n<td><a href = 'trans.php?ref=" . $row["acc_ref"] . "' title = 'View transactions' class = 'accountlink'>" . $row["acc_name"] . "</a></td>";
			
			
			
			echo "<td>" . $row["acc_comment"] . "</td>";
			
			// Break to get account balances
			
				$id = $row["accountID"];
			
			
			
		
					// Get accounts sums

					$sql2 = "SELECT SUM(tran_amount) as total FROM transactionsT WHERE trans_accountID = '$id' and tran_enabled > 0";
					$result2 = $conn->query($sql2);
					
					

					if ($result->num_rows > 0) {
						// output data of each row
						while($row2 = $result2->fetch_assoc()) {
							

								$totalArray[] = $row2['total'];
								
									if ( $row2['total'] == "" ) {
										
										echo "<td>0.00</td>";	// if the account has nil transactions display 0 balance						
									
											// Save the balnce
											// JSON format to cahce and use later	
											$_SESSION["AccountBalance_" . $row["acc_ref"]] = "0.00";
									
									} else {
									
										echo "<td>" . $row2['total'] . "</td>";
									
											// Save the balnce
											$_SESSION["AccountBalance_" . $row["acc_ref"]] = $row2["total"];
									
									}
									

							
						}
					} else {
							echo "<td>0.00</td>";
					}
			
		
			
			
	echo "
		
		\n</tr>
		
		<!-- Account list built by SQL -->
		
		";
		
	}
	
	
	// Encode the array and store in a session
	$_SESSION["account_rebuild_cache"] = 1;

}




?>