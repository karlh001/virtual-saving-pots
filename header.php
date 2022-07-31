<?php
ob_start( 'ob_gzhandler' ); 
session_start(); // starts the php session
session_regenerate_id(); // regenerates session key
error_reporting(0);
?>

<!--



~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
Thank you for using Virtual Saving Pots
By Karl on GitHub
Email: karldev@fastmail.co.uk
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Source code:
https://github.com/karlh001/virtual-saving-pots

Licence 
https://github.com/karlh001/virtual-saving-pots/blob/master/LICENCE

Issue tracking
https://github.com/karlh001/virtual-saving-pots/issues





















-->
<?php


include("php/cnx.php");

	// Check if new session
	if ($_GET["p"] == TRUE) {
		
		// Set the session from URL
		$_SESSION["profileID"] = strip_tags($_GET["p"]);
				
		
		$Profile_ID_session = $_SESSION["profileID"];
		
			// Get profile name from JSON
				
				$Profile_JSON = $_SESSION["ProfileID_" . $Profile_ID_session];
			  
				// Decode the JSON format
				$obj = json_decode($Profile_JSON);
			  
				// Extract variables
				$profilename = $obj->Name;
				$profiledescription = $obj->Description;
			  
				// Output to SESSION
				
				$_SESSION["profile_name"] = $profilename;
				$_SESSION["profile_description"] = $profiledescription;


	} else {

		// However if no ID found from URL, check if session exisits
		if ( $_SESSION["profileID"] == FALSE ) {
		echo "<h3>No profile selected.</h3><br><a href='accounts.php?p=1' title = 'Select the default profile'>Default</a>";
		include("footer.php");
		exit;
		}
			
	}

	// Set profile ID to session
	$ProfileID = $_SESSION["profileID"];

// Get profiles
include("php/get_profile.php");




?>

<!DOCTYPE html>

<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="//cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

<link rel="icon" type="image/x-icon" href="img/icon.png">

<title>Virtual Saving Pots</title>

<!--JQuery-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--Bootstrap-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>

<!-- Datatables -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>

<!--Icofont-->
<link rel="stylesheet" href="plugins/icofont/icofont.min.css">

<!--Plug-ins-->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="plugins/moneymask/src/jquery.maskMoney.js" type="text/javascript"></script>


</head>

<body>


<style>

	th { font-size: 20px; }
	td { font-size: 20px; }

</style>


	<nav class="navbar navbar-expand-lg navbar-light bg-light">
 
      <a class="navbar-brand" href="accounts.php"><i class="icofont-money-bag"></i> Virtual Saving Pots</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			  Profiles
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			 

			 <?php
			 
			 // Load the cached profiles on the menu bar
			 
			 $ProfileIndex = $_SESSION["profile_index"];

				$counter=0;
					
				foreach ($ProfileIndex as $value) {
				  
					
					if ( $counter > 10 ) {
						
						echo " <a class='dropdown-item' href='manage_profiles.php' title = 'Choose more profiles'>More ...</a>";
						exit();
						
					}
					
					// Get JSON from session
					
					$Profile_JSON = $_SESSION["ProfileID_" . $value];
				  
					// Decode the JSON format
					$obj = json_decode($Profile_JSON);
				  
					// Extract variables
					$profileID = $obj->ID;
					$profilename = $obj->Name;
					$profiledescription = $obj->Description;
				  
					// Out put to HTML

					echo " <a class='dropdown-item' href='accounts.php?p=$profileID' title = '$profiledescription'>$profilename</a>\n";

					$counter++;
				
				}
				
			 
			 ?>


			  <div class="dropdown-divider"></div>
			  <a class="dropdown-item" href="#">Manage profiles</a>
			</div>
		  </li>
	  
				<li class="nav-item">
			<a class="nav-link disabled" href="#"><?php echo $_SESSION["profile_name"]; ?></a>
		  </li>
		</ul>
	  
	  </div>

    </nav>
    
    
     <main role="main" class="container" style="padding-top:10px;">
