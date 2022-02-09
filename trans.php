<?php

		include("header.php");



		// List of transactions


		$acc = strip_tags($_GET["ref"]);


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
				 
			 }
			 
		 } else {
			 
			 
			 echo "No such account";
			exit(); 
		 }


		echo "<h1>$accName</h1>";

		// gets list of accounts

			$sql = "
			SELECT * FROM accountsT
			LEFT JOIN transactionsT
			ON transactionsT.trans_accountID = accountsT.accountID
			WHERE tran_enabled > 0
			AND acc_ref = '$acc'
			";

			$result = $conn->query($sql);


				if ( $_GET["msg"] == "done" ) {
						
						echo "
						<div class='alert alert-success'>
						  <strong>Success!</strong> New transaction added.
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
							<th>Amount (£)</th>
							<th></th>
							
						</tr>
						
					</thead>

					<tbody>
					
					";
					
					
				
		// Display results

		if ($result->num_rows > 0) {
			
			
			 while($row = $result->fetch_assoc()) {
						
						$id = $row["accountID"];
						
						
				echo "\n<tr>
				
									
							<td>" . $row["tran_date"] . "</td>
							<td>" . $row["tran_comment"]  . "</td>
							<td>" . $row["tran_amount"] . "</td>
							<td><a href = 'php/delete_trans.php?ref= " . $row["transID"] ."&acc=" . $acc . "' title = 'Delete transaction'><i class='fa fa-trash-o' aria-hidden='true'></i>
		</a></td>

				
				\n</tr>";
				
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
				
				$sql2 = "SELECT SUM(tran_amount) as total FROM transactionsT WHERE trans_accountID = '$id' and tran_enabled > 0";
				$result2 = $conn->query($sql2);
							
							

							if ($result->num_rows > 0) {
								// output data of each row
								while($row2 = $result2->fetch_assoc()) {
									
									
									echo "<p style = 'text-size: 20px'>Total: <b>£ " . $row2['total'] . "</b></p>";

									
							}
						}
			
			 // Create a new transaction form
		  ?>
		  
		  <p style = "text-align:right;"><a href="php/delete_account.php?ref=<?php echo $acc ?>&confirm=yes" class="btn btn-danger" role="button">Delete</a></p>
		
			<br>
			<form action = 'php/inc_trans_add.php' method = 'POST'>
			

				<input type = 'text' value = '<?php echo $id ?>' name = 'id' hidden>
				<input type = 'text' value = '<?php echo $acc ?>' name = 'ref' hidden>

				Date <input type = 'text' id = 'datepicker' name = 'date' value = '<?php echo date("Y-m-d") ?>'><br>
				Description <input type = 'text' name = 'comment'><br>
				Amount <input type = 'text' id = 'amount' name = 'amount' value = '0.00'><br>
				<input type='checkbox' name='addcheck' value='1'> Increase<br><br>
				<input type = 'submit' value = 'Add'>

			</form>
			

		<script type="text/javascript">$("#amount").maskMoney();</script>


		<script>

			$(document).ready(function() {
			
				$('#transTbl').DataTable( {
					
						
				'lengthMenu': [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, 'All']],
				'iDisplayLength': 10,
				 'order': [[ 0, 'desc' ]]
					
				});
				
				
				
			} );
			
			
			$( function() {
				$('#datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
			} );
	  
			
		</script>


	<?php include("footer.php");?>

