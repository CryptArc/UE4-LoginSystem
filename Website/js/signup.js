$(document).ready( function() {
	$(".signup-form input[name=uid]").on("input paste",function(){
    	var a = $(this).val().replace(/[^a-zA-Z0-9]/g,'');
		$(this).val(a);
	  
		if($(this).val().length > 0){ /* Check if input empty before ajax call */
			$.ajax({
				url: "/sys/checkuser.sys.php",
				type: "POST",
				data: {uid: $(this).val()},
				success: function(response){
			  /* Change input color if username is free/taken */
					if(response){
						uid_color("green");
					}else{
						uid_color("red");
					}
				}
			});//AJAX CALL END
		}else{
			uid_color("red");
		}

	});
	
	function uid_color(x){
		$(".signup-form input[name=uid]").css({"border-color":x,"color":x});
	}
});
