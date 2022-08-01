<?php

		include("header.php");


		echo "<h1>Profiles</h1>";
		
		
				echo "

				<table id='profileTbl' class='cell-border' width='100%' cellspacing='0'>
				
					<thead>
					
						<tr>
						
							<th>Name</th>
							<th>Description</th>
							<th></th>

						</tr>
						
					</thead>

					<tbody>
					
					";
					
				

		// get account number

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
						
						
						echo "\n<tr>";
				
						
						// Out put to HTML
					if ( $ProfileID == $_SESSION["profileID"] ) {
						// Display open folder
						echo "<td><i class='icofont-ui-folder'></i> ";
					
					} elseif ( $ProfileID == FALSE){
						// Display closed folder
						echo "<td><i class='icofont-folder'></i> ";
					
					} else {
						// Display closed folder
						echo "<td><i class='icofont-folder'></i> ";
					
					}

						
						echo "
						<a href='accounts.php?p=$ProfileID' title = 'Select profile'>" . $ProfileName . "</a></td>
							<td>" . $ProfileDesc . "</td>
							<td></td>";
							
			echo "
				\n</tr>";
				 
			 }
			 
		 } else {
			 
			 
			echo "No profiles found.";
			include("footer.php");
			exit(); 
			
		 }


				
				echo "
				  
				</tbody>
				
			</table><br>";



		// Gets list of accounts

		

			$result = $conn->query($sql);


				if ( $_GET["msg"] == "done" ) {
						
						echo "
						<div class='alert alert-success'>
						  <strong>Success!</strong> New transaction added.
						</div>";
						
							
				}	
				
				if ( $_GET["msg"] == "done-copy" ) {
						
						echo "
						<div class='alert alert-success'>
						  <strong>Success!</strong> Transaction copied.
						</div>";
						
							
				}
				
					if ( $_GET["msg"] == "fail" ) {
						
						
							echo "
						<div class='alert alert-danger'>
						  <strong>Success!</strong> New transaction added.
						</div>";
						
						
					
						
				}
				
						if ( $_GET["msg"] == "error" ) {
						
							echo "
						<div class='alert alert-danger'>
						  <strong>Error!</strong> Transaction could not be created.
						</div>";
						
						
						
						
				}
				
				
						if ( $_GET["msg"] == "error-acc" ) {
						
							echo "
						<div class='alert alert-danger'>
						  <strong>Error!</strong> Transaction could not be deleted.
						</div>";
						
						
						
						
				}
				
				
						if ( $_GET["msg"] == "delete" ) {
						
						
							echo "
						<div class='alert alert-alert'>
						  <strong>Success!</strong> Transaction has been delete.
						</div>";
				
						
				}



		  ?>
		  
		  <!-- Create a new profile modal -->
		  
		  <p style = "text-align:right;">
		  <!-- Button trigger modal -->
		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProfile">New</button> 

		

			
		<!-- Change account name modal -->

		<!-- Modal -->
		<div class="modal fade" id="createProfile" tabindex="-1" role="dialog" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create new profile</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				
					<div class="alert alert-danger" id = "errorMsg" style = "display:none;">
					  <strong>Error!</strong> Account could not be created.
					  <p class="errorMessage"></p>
					</div>
				
						<form id = "ProfileForm">
							  <div class="form-group row">
								<label for="profileName" class="col-4 col-form-label">Name</label> 
								<div class="col-8">
								  <div class="input-group">
									<div class="input-group-prepend">
									  <div class="input-group-text">
										<i class="icofont-paper"></i>
									  </div>
									</div> 
									<input id="profileName" name="profileName" type="text" class="form-control" required="required">
								  </div>
								</div>
							  </div>
							  <div class="form-group row">
								<label for="profileDesc" class="col-4 col-form-label">Description</label> 
								<div class="col-8">
								  <div class="input-group">
									<div class="input-group-prepend">
									  <div class="input-group-text">
										<i class="icofont-paper"></i>
									  </div>
									</div> 
									<input id="profileDesc" name="profileDesc" type="text" class="form-control">
								  </div>
								</div>
							  </div> 		
					  </div>
					  <div class="modal-footer">
						
						<!--<button type="button" class="btn btn-primary">Create</button>-->
						<input type = "submit" class = "btn btn-primary" value = "Create">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						
						</form>
					  
					  </div>
					</div>
				  </div>
				</div>

		<script>
			<!-- Sets datatable options -->
			$(document).ready(function() {
			
				$('#profileTbl').DataTable( {
				
				'lengthMenu': [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, 'All']],
				'iDisplayLength': 10,
				 'order': [[ 0, 'desc' ]]
					
				});
				
				$('#datepicker').datepicker({
					format: 'yyyy/mm/dd',
					startDate: '-3d'
				});
				
			});
		</script>


	<?php include("footer.php");?>

