
{{ HTML::style('public/plugins/chosen/chosen.css') }}
{{ HTML::script('public/plugins/chosen/chosen.jquery.min.js') }}

<script type="text/javascript">


$(document).ready(function()
{
	$(".chzn-select").chosen();
	$(".chzn-select-deselect").chosen({allow_single_deselect:true}); 

	if($("#student_info > .activity").length <= 0)
		$("#student_info > h2").hide();

})


function profileResponse(response_text, $form) {
	if($form.attr('id') == "profile_form")
	{
		if(response_text.indexOf('success') > -1)
		{
			$form.find('h2').after('<div class="success">Password has been changed successfully</div>');
		}
		else
		{
			$form.find('h2').after('<div class="error">' + response_text + '</div>')
		}
	}

}

</script>