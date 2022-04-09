		
	$(document).ready(function(){
    
				$("#SaveNoteForm").submit(function(){
						
                        console.log("submit");

						// Clear error message
						$("#ErrorCross").hide();	
						$("#SuccessTick").hide();
						
						// POST to php script
						$.post("php/save_note.php", $(this).serialize(), function(data){
							
							var $Acc = $("#Acc").val();
							var $AccNotes = $("#AccNotes").val();
							
							var response = data;
							console.log(response);
				
							if (response == 1 ) {

								// Returns 1 when successful
								console.log("Success");
								$("#SuccessTick").show();
								return false;

							} else {

								console.log("Error with form");
                                $("#ErrorCross").show();

							}
							
						}).fail(function() {
						 
							// just in case posting your form failed
							console.log("AJAX failed by PHP");
							$("#ErrorCross").show();

						});
									 
						// to prevent refreshing the whole page page
						return false;
				});
	});

