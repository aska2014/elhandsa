{{ HTML::style('public/plugins/chosen/chosen.css') }}
{{ HTML::script('public/plugins/chosen/chosen.jquery.min.js') }}
<script type="text/javascript">
	$(document).ready(function()
	{
		$("#materials_head").delay(1000).fadeTo(3000, '0.3');
		$(".chzn-single > span").css({'text-align': 'right', 'font-size': '16px'});
		$(".chzn-results > li").css({'text-align': 'right', 'font-size': '16px'});

		$("#step3").show();

		$("#l_step3").css('background', '#f25050');
		
	});
	$(".chzn-select").chosen();
	$(".chzn-select-deselect").chosen({allow_single_deselect:true}); 

</script>