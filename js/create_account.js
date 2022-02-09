		
	$(document).ready(function(){
    
				$("#CreateAccForm").submit(function(){
						
                        console.log("submit");

						// Clear error message
						$(".errorMsgText").text("");	
						
						// POST to php script
						$.post("php/inc_create_acc_script.php", $(this).serialize(), function(data){
							
							var $Name = $("#accName").val();
							var $Description = $("#accComment").val();
							
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
                                $("#errorMsg").show();
								$(".errorMessage").text(response);

							}
							
						}).fail(function() {
						 
							// just in case posting your form failed
							console.log("AJAX failed by PHP");

						});
									 
						// to prevent refreshing the whole page page
						return false;
				});
	});

