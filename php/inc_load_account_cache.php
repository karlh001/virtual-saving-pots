<?php

 // Load the cached profiles on the menu bar
			 
 $AccountIndex = $_SESSION["account_index"];

		
	foreach ($AccountIndex as $value) {
	  		
		// Get JSON from session
		
		$Acc_JSON = $_SESSION["AccountID_" . $value];
	  
		// Decode the JSON format
		$obj = json_decode($Acc_JSON);
	  
		// Extract variables
		$accID = $obj->ID;
		$accName = $obj->Name;
		$accDesc = $obj->Description;
		$accBal = $_SESSION["AccountBalance_" . $accID];

		// Output accounts into the table
				
		echo "<tr>
		
			\n<td><a href = 'trans.php?ref=" . $accID . "' title = 'View transactions' class = 'accountlink'>" . $accName . "</a></td>";
			
		echo "<td>" . $accDesc . "</td>";
		echo "<td>" . $accBal . "</td>";
			
		echo "</tr>";
		
		echo "\n<!-- account built with cache -->";
		
	}

?>