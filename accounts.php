<?php

include("header.php");



	if ( $_GET["do"] == "new" ) {

		include("php/inc_create_acc.php");

		exit();
		include("footer.php");
	
	}




// This page lists all acounts and their respective balances



// gets list of accounts

$sql = "SELECT * from accountsT WHERE acc_enabled > 0";

$result = $conn->query($sql);


	if ( $_GET["msg"] == "success" ) {
		
			echo "
		<div class='alert alert-success'>
		  <strong>Success!</strong> New account has been added.
		</div>";
	
			
	}
	
	if ( $_GET["msg"] == "delete" ) {
		
			echo "
		<div class='alert alert-success'>
		  <strong>Success!</strong> Account has been deleted.
		</div>";
	
			
	}

	if ( $_GET["msg"] == "fail" ) {
			
		echo "
		<div class='alert alert-danger'>
		  <strong>Error!</strong> New account could not be added.
		</div>";

	}
	
	?>



	<table id='accounts' class='hover' width='100%' cellspacing='0'>
    
        <thead>
        
            <tr>
            
                <th>Account Name</th>
                <th>Comment</th>
                <th>Balance</th>
                
            </tr>
            
        </thead>

        <tbody>
        
 <?php
        
        
        
// Display results

if ($result->num_rows > 0) {
	
	
     while($row = $result->fetch_assoc()) {
				
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
							
							} else {
							
							echo "<td>" . $row2['total'] . "</td>";
							
							}
						
						}
					} else {
							echo "<td>0.00</td>";
					}
			
		
			
			
	echo "
		
		\n</tr>";
		
	}
	
	
}
        
?>
          
        </tbody>
        
    </table>
	
	<div class="container">
	  <div class="row">
		<div class="col-sm">
		
		<p style="font-size: 20px;">Total Balance: <span id = "GetTotalID"><?php echo array_sum($totalArray) ?></span></p>

		  
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createAccount">
		 <i class="icofont-plus"></i> Create account
		</button>
		  
		<button id = "CopyBtn" type="button" class="btn btn-secondary"><i class="icofont-ui-copy"></i> Copy balance</button>
		 
		</div>

	  </div>
	</div>
	
	
	
		<!-- Modal -->
		<div class="modal fade" id="createAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create new fund</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				
					<div class="alert alert-danger" id = "errorMsg" style = "display:none;">
					  <strong>Error!</strong> Account could not be created.
					  <p class="errorMessage"></p>
					</div>
				
						<form id = "CreateAccForm">
							  <div class="form-group row">
								<label for="accName" class="col-4 col-form-label">Pot name</label> 
								<div class="col-8">
								  <div class="input-group">
									<div class="input-group-prepend">
									  <div class="input-group-text">
										<i class="icofont-money-bag"></i>
									  </div>
									</div> 
									<input id="accName" name="accName" type="text" class="form-control" required="required">
								  </div>
								</div>
							  </div>
							  <div class="form-group row">
								<label for="accComment" class="col-4 col-form-label">Description</label> 
								<div class="col-8">
								  <div class="input-group">
									<div class="input-group-prepend">
									  <div class="input-group-text">
										<i class="icofont-comment"></i>
									  </div>
									</div> 
									<input id="accComment" name="accComment" type="text" class="form-control">
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


<script src="js/create_account.js"></script>





<script>

	$(document).ready(function() {
	
		$('#accounts').DataTable( {
		
		'lengthMenu': [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, 'All']],
		'iDisplayLength': 50,
		'order': [[ 2, 'desc' ]],
				
		} );
		
		
		$('#createAccount').on('shown.bs.modal', function () {
		  $('#myInput').trigger('focus')
		})
		
		
	} );
	
	<!-- Source: https://www.codehaven.co.uk/jquery/jquery-tricks/copy-text-from-a-div-to-clipboard-cut-and-paste/
	-->
	$(document).on('click', '#CopyBtn', function() { 
		var range = document.createRange();
		range.selectNode(document.getElementById("GetTotalID"));
		window.getSelection().removeAllRanges(); // clear current selection
		window.getSelection().addRange(range); // to select text
		document.execCommand("copy");
		window.getSelection().removeAllRanges();// to deselect
	});
	
</script>


<?php include("footer.php"); ?>
