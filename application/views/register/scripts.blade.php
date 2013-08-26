{{ HTML::style('public/plugins/chosen/chosen.css') }}
{{ HTML::script('public/plugins/chosen/chosen.jquery.min.js') }}
<script type="text/javascript">
	$(document).ready(function()
	{
		if($("#r_year").val() == "0")
		{
			$("#r_department_chzn").hide();
			$("#r_preparatory_department_chzn").show();
		}
		else
		{
			$("#r_preparatory_department_chzn").hide();
			$("#r_department_chzn").show();
		}
		// For users with slow internet connection
        $("#step1").show();
		$("#step2").show();
		$("#step2").hide();
		////////////////////////////
		
		$("#r_email").focus();

		$("#r_year").change(function()
		{
			if($(this).val() == "0")
			{
				$("#r_department_chzn").hide();
				$("#r_preparatory_department_chzn").show();
			}
			else
			{
				$("#r_preparatory_department_chzn").hide();
				$("#r_department_chzn").show();
			}
		});

		$("#l_step1").css('background', '#f25050');
		$(".sbmt").click(function()
		{
			$("#steps").find('div').css('background','#BBB');
			if($(this).attr('id') == "sbmt1")
			{
				var email = $("#r_email").val();
				var first_name = $("#r_first_name").val();
				var last_name = $("#r_last_name").val();
				var password = $("#r_password").val();
				var year = $("#r_year").val();
				var department = $("#r_department").val();
				var error_text = "";

				if(!validateEmail(email))
					error_text += "Email is not Valid<br />";
				if(first_name.length < 3)
					error_text += "Firstname must be more than two characters<br />";
				if(last_name.length < 3)
					error_text += "Lastname must be more than two characters<br />";
				if(password.length < 7)
					error_text += "Password must be more than 7 characters<br />";
				if(!(parseInt(year) < 6))
					error_text += "You have to select year<br />";
					
				if(error_text == "")
				{
					$("#l_step2").css('background', '#f25050');
					$("#step1").hide();
					$("#step2").fadeTo(500,1);
					$("#r_cell_phone").focus();
					$("#r_year_chzn").hide();
					$("#r_department_chzn").hide();
					$("#r_preparatory_department_chzn").hide();
				}
				else
				{
					$("#l_step1").css('background', '#f25050');
					$(".error").html(error_text);
				}
				return false;
			}
			else if($(this).attr('id') == "sbmt2")
			{
			}
		});


		$(".d_sbmt").click(function()
		{
			$("#steps").find('div').css('background','#BBB');
			if($(this).attr('id') == "d_sbmt1")
			{
				var doctor_id = $("#doctor_id").val();

				var error_text = "";
				if(doctor_id == null)
					error_text = "You have to select doctor name<br />";
				
				if(error_text == "")
				{
					$("#l_step2").css('background', '#f25050');
					$("#step1").fadeTo(500,0);
					$("#step2").fadeTo(500,1);
				}
				else
				{
					$("#l_step1").css('background', '#f25050');
					$(".error").html(error_text);
				}
				return false;
			}
			else if($(this).attr('id') == "d_sbmt2")
			{
				var about = $("#about").val();

				var error_text = "";
				if(about.length < 10)
					error_text = "You have to write something about yourself";

				if(error_text == "")
				{
					$("#l_step3").css('background', '#f25050');
					$("#step2").fadeTo(500,0);
					$("#step3").fadeTo(500,1);
				}
				else
				{
					$("#l_step2").css('background', '#f25050');
					$(".error").html(error_text);
				}
				return false;
			}
			else if($(this).attr('id') == "d_sbmt3")
			{
			}
		});
	});
	$(".chzn-select").chosen();
	$(".chzn-select-deselect").chosen({allow_single_deselect:true}); 

	function validateEmail(email) { 
	    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	    return reg.test(email);
	} 

</script>