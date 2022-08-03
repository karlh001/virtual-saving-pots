<?php

include("header.php");



	if ( $_GET["do"] == "new" ) {

		include("php/inc_create_acc.php");

		exit();
		include("footer.php");
	
	}




// This page lists all acounts and their respective balances


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



	<table id='accounts' class='hover' width='100%' cellspacing='0' lass="display nowrap">
    
        <thead>
        
            <tr>
            
                <th data-priority="1">Account Name</th>
                <th>Comment</th>
                <th data-priority="2">Balance</th>
                
            </tr>
            
        </thead>

        <tbody>
        
 <?php
        
		
		
	// Load accounts 

	if ( $_SESSION["account_rebuild_cache"] == 0 OR $_SESSION["account_rebuild_cache"] == FALSE) {
		// Load page using the cache
		include("php/inc_load_account_sql.php");
		
	} else {
		// Otherwise load the accounts using
		// a SQL query
		include("php/inc_load_account_cache.php");		
		
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

		'order': [[ 2, 'desc' ]],
		responsive: true,
			columnDefs: [
				{ responsivePriority: 1, targets: 0 },
				{ responsivePriority: 2, targets: -1 }
			]
						
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
