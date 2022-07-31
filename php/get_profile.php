<?php
#
#	This page will run a script to get all the user's profiles
#	Then the profiles will be cached in a PHP session for fast loading
#	If a new profile is created, modified or deleleted this will 
#	trigger a profile re-load
#

	// Check if using cache

	if ( $_SESSION["profile_use_cache"] == FALSE ) { # 1 or not empty

		// Rebuild the cache
		$sql = "
			SELECT * FROM profileT
			WHERE profile_active = 1
			";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				
				
				 while($row = $result->fetch_assoc()) {
					 
					$ProfileID = $row["profile_ID"]; 
					$ProfileName = $row["profile_name"]; 
					$ProfileDesc = $row["profile_description"]; 
					 
					$ProfileIndex[] = $ProfileID; 
					 
					// Save the account details into a
					// JSON format to cahce and use later
					$proArray = array("ID"=>$ProfileID, "Name"=>$ProfileName, "Description"=>$ProfileDesc);
					// Encode the array and store in a session
					$_SESSION["ProfileID_" . $ProfileID] = json_encode($proArray);		

				 }
				 
			}

	}
	
	// Set variable to use profile cache
	$_SESSION["profile_use_cache"] = 1;
	$_SESSION["profile_index"] = $ProfileIndex;

?>