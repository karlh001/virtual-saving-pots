<?php

		include("header.php");

		// Get profile ID
		$ProfileID = $_SESSION["profileID"];


		// List of transactions


		$acc = strip_tags($_GET["ref"]);

		// Check if general ledger
		
		if ( $acc == "ledger" ) {
			
			echo "<h2>Ledger</h2>\n<br>\n";
			
		// List all transactions from all accounts
		
			if ( $_GET["view"] == "all" ) {
			// Show all transactions
				$sql = "
					SELECT * FROM accountsT
					LEFT JOIN transactionsT
					ON transactionsT.trans_accountID = accountsT.accountID
					LEFT JOIN profileT
					ON profileT.profile_ID = accountsT.profile_ID
					WHERE tran_enabled > 0
					AND accountsT.profile_ID = $ProfileID
					ORDER BY tran_date DESC
					LIMIT 50
				";
			} else {
			// Limit to 50 transactions
				$sql = "
					SELECT * FROM accountsT
					LEFT JOIN transactionsT
					ON transactionsT.trans_accountID = accountsT.accountID
					LEFT JOIN profileT
					ON profileT.profile_ID = accountsT.profile_ID
					WHERE tran_enabled > 0
					AND accountsT.profile_ID = $ProfileID
					ORDER BY tran_date DESC
					LIMIT 50
				";

			
			}
			
			
		} else {
			
			// get account number

			$sql = "
			SELECT * FROM accountsT
			WHERE acc_ref = '$acc'
			";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				
				
				 while($row = $result->fetch_assoc()) {
					 
							
							$id = $row["accountID"];
							$accName = $row["acc_name"];
							$accDesc = $row["acc_comment"];
							$accNote = $row["acc_notes"];
					 
				 }
				 
			 } else {
				 
				 
				 echo "No such account";
				exit(); 
			 }


			echo "<h1>$accName</h1>";

			// Gets list of accounts

			// Check if able to view all
			
			if ( $_GET["view"] == "all" ) {
				$sql = "
				SELECT * FROM accountsT
				LEFT JOIN transactionsT
				ON transactionsT.trans_accountID = accountsT.accountID
				WHERE tran_enabled > 0
				AND acc_ref = '$acc'
				ORDER BY tran_date DESC
				";
			} else {
				$sql = "
				SELECT * FROM accountsT
				LEFT JOIN transactionsT
				ON transactionsT.trans_accountID = accountsT.accountID
				WHERE tran_enabled > 0
				AND acc_ref = '$acc'
				ORDER BY tran_date DESC
				LIMIT 50
				";
				
				// Sets limit variable
				$Limit = 1;
				
			}


		}
		
		
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

			echo "

				<table id='transTbl' class='cell-border' width='100%' cellspacing='0'>
				
					<thead>
					
						<tr>
						
							<th>Date</th>
							<th>Description</th>
							<th>Amount</th>
							<th></th>
							
						</tr>
						
					</thead>

					<tbody>
					
					";
					
					
				
		// Display results
		$Counter = 0;

		if ($result->num_rows > 0) {
			
			
			 while($row = $result->fetch_assoc()) {
						
						$id = $row["accountID"];
						$TransID = $row["transID"];
						
				echo "\n<tr>
				
									
							<td>" . $row["tran_date"] . "</td>
							<td>" . $row["tran_comment"]  . "</td>
							<td>" . $row["tran_amount"] . "</td>";
							
							// Check date and if less than 5 days then disable delete
							
							
							//7 days ago - last week.
							$lastWeek = date("Y-m-d", strtotime("-7 days"));
							
							$time1 = strtotime($row["tran_date"]);
							$time2 = strtotime($lastWeek);
							
							// Do not display if on ledger mode
							if ( $_GET["ref"] == "ledger" ) {
								
								echo "<td></td>";
								
							} else {
														
								if ( $row["tran_date"] < $lastWeek ) {
								  echo "<td><i class='icofont-ui-delete'></i> ";
								  echo "<a href='php/copy.php?id=$TransID&ref=$acc'><i class='icofont-ui-copy'></i></a></td>";
								} else {
								  echo "<td><a href = 'php/delete_trans.php?ref= " . $row["transID"] ."&acc=" . $acc . "' title = 'Delete transaction'><i class='icofont-ui-delete'></i></a> ";
								  echo "<a href='php/copy.php?id=$TransID&ref=$acc'><i class='icofont-ui-copy'></i></a></td>";
								}
							}

			echo "
				\n</tr>";
			
			// Add to counter
			$Counter++;	
			
			}
			
			
			
		} else {
			

			echo "<td></td>";
			echo "<td>No transactions</td>";
			echo "<td></td>";
			echo "<td></td>";
			
		} 
				
			  
				
				echo "
				  
				</tbody>
				
			</table><br>";
			
						
				// Display total
				// Do not display the total if on the ledger report
				if ($_GET["ref"] !== "ledger") {
				$sql2 = "SELECT SUM(tran_amount) as total FROM transactionsT WHERE trans_accountID = '$id' and tran_enabled > 0";
				$result2 = $conn->query($sql2);
							
							

							if ($result->num_rows > 0) {
								// output data of each row
								while($row2 = $result2->fetch_assoc()) {
									
									// Total account balance modal
									echo "
									
									<div class='alert alert-info' role='alert'>
									  Total: <b>£ " . $row2['total'] . "</b>
									</div>
									
									";

									
							}
						}
				}
				
			// Display view all transaction link
			If ( $Limit > 0 and $Counter > 49 ) {
			echo "<i class='icofont-info-circle'></i> Transactions limited to 50 <a href='trans.php?ref=$acc&view=all' title='View all transaction may take longer to load'>View all</a>";
			}	
			
			
			
			 // Create a new transaction form
		  ?>
		  
		  <p style = "text-align:right;">
		  <!-- Button trigger modal -->
		  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ChangeAccModal">Edit</button> 
		  <a href="php/delete_account.php?ref=<?php echo $acc ?>&confirm=yes" class="btn btn-danger" role="button">Delete</a></p>
		
			<!-- Container for transaction form and account note form -->
			<div class="container">
			   <div class="row justify-content-md-center">
				<div class="col col-sm">
				  	
					<form action = 'php/inc_trans_add.php' method = 'POST'>
									
						<div class="form-group">
						<label for="date">Date</label> 
						<div class="input-group">
						  <div class="input-group-prepend">
							<div class="input-group-text">
							  <i class="icofont-ui-calendar"></i>
							</div>
						  </div> 
						  <input id="datepicker" name = "date" type="text" required="required" class="form-control" value="<?php echo date("Y-m-d") ?>">
						</div>
						</div>
						<div class="form-group">
						<label for="comment">Description</label> 
						<div class="input-group">
						  <div class="input-group-prepend">
							<div class="input-group-text">
							  <i class="icofont-pencil"></i>
							</div>
						  </div> 
						  <input id="comment" name="comment" type="text" required="required" class="form-control">
						</div>
						</div>
						<div class="form-group">
						<label for="amount">Amount</label> 
						<div class="input-group">
						  <div class="input-group-prepend">
							<div class="input-group-text">
							  <i class="icofont-bill-alt"></i>
							</div>
						  </div> 
						  <input id="amount" name="amount" type="text" required="required" class="form-control">
						</div>
						</div>
						<div class="form-group">
						<label></label> 
						<div>
						  <div class="custom-control custom-checkbox custom-control-inline">
							<input name="addcheck" id="addcheck" type="checkbox" class="custom-control-input" value="1"> 
							<label for="addcheck" class="custom-control-label">Increase</label>
						  </div>
						</div>
						</div> 
						<div class="form-group">
						<button name="submit" type="submit" class="btn btn-primary">Add</button>
						</div>
								
											
						<input type = 'text' value = '<?php echo $id ?>' name = 'id' hidden>
						<input type = 'text' value = '<?php echo $acc ?>' name = 'ref' hidden>
						
					</form>
				</div><!-- end of container div -->
				
				
				 
				 <div class="w-100"></div>	
				 
				 <div class="col col-sm">
				  <!-- Note form  -->
					  <form id = "SaveNoteForm">
						<input type = 'text' value = '<?php echo $id ?>' id = 'Acc' name = 'Acc' hidden>
						  <div class="form-group row">
							<div class="col-8">
							  <textarea id="AccNotes" name="AccNotes" cols="40" rows="5" class="form-control"><?php echo $accNote ?></textarea>
							</div>
						  </div> 
						  <div class="form-group row">
							<div class="col-8">
							  <button name="submit" type="submit" class="btn btn-primary">
							  <i class="icofont-save"></i> Save</button>
							  <i id="SuccessTick" style="color:darkgreen; display:none;" class="icofont-check-circled"></i>
							  <i id="ErrorCross" style="color:red; display:none;" class="icofont-error"></i>
							</div>
						  </div>
						</form>
						
				</div>
			  </div>
			</div>
			
			
		<!-- Change account name modal -->

				<div class="modal" id="ChangeAccModal" tabindex="-1" role="dialog">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title">Edit Account Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  
					  <div id = "errorMsgChangeAccount" class="alert alert-danger" style = "display: none;">
						  <strong>Error!</strong> <span class = "errorMsgTextChangeAccount"></span>
						</div>
					  
						<p>Change account name and short description.</p>
						
						<form id = "ChangeFrm">
						<input type = 'text' value = '<?php echo $acc ?>' id = 'account' name = 'account' hidden>
						  <div class="form-group row">
							<label for="name" class="col-3 col-form-label">Pot name</label> 
							<div class="col-9">
							  <div class="input-group">
								<div class="input-group-prepend">
								  <div class="input-group-text">
									<i class="icofont-money-bag"></i>
								  </div>
								</div> 
								<input id="name" name="name" type="text" class="form-control" value="<?php echo $accName; ?>">
							  </div>
							</div>
						  </div>
						  <div class="form-group row">
							<label for="desc" class="col-3 col-form-label">Description</label> 
							<div class="col-9">
							  <div class="input-group">
								<div class="input-group-prepend">
								  <div class="input-group-text">
									<i class="icofont-comment"></i>
								  </div>
								</div> 
								<input id="desc" name="desc" type="text" class="form-control" value="<?php echo $accDesc; ?>">
							  </div>
							</div>
						  </div> 
							
					  </div>
					  <div class="modal-footer">
						<button type="submit" class="btn btn-primary">Save</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					  </form></div>
					</div>
				  </div>
				</div>
						

		<!--
				Additional scripts to load
				Load moneymask plugin
				Save note jquery script
				and change account jquery script
		-->
		<script type="text/javascript">$("#amount").maskMoney();</script>
		<script src="js/save_note.js"></script>
		<script src="js/change_account.js"></script>

		<script>
			<!-- Sets datatable options -->
			$(document).ready(function() {
			
				$('#transTbl').DataTable( {
				
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

