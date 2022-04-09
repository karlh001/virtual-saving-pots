		
	$(document).ready(function(){
    
				$("#ChangeFrm").submit(function(){
						
                        console.log("submit");

						// Clear error message
						$(".errorMsgTextChangeAccount").text("");	
						$("#errorMsgChangeAccount").hide();
						
						// POST to php script
						$.post("php/change_account.php", $(this).serialize(), function(data){
							
							var $Name = $("#name").val();
							var $Description = $("#description").val();
							
							var response = data;
							console.log(response);
				
							if (response == 1 ) {

								// Returns 1 when successful
								console.log("Success");

								// Refresh page
								location.reload();
							
								return false;

							} else {

								console.log("Error with form");
                                $("#errorMsgChangeAccount").show();
								$("errorMsgTextChangeAccount").text(response);

							}
							
						}).fail(function() {
						 
							// just in case posting your form failed
							console.log("AJAX failed by PHP");

						});
									 
						// to prevent refreshing the whole page page
						return false;
				});
	});

