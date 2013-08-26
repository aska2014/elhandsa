{{ HTML::script('public/plugins/form/form.js') }}
{{ HTML::script('public/js/global.js')}}
<script type="text/javascript">

function updateView()
{
	@if(isset($footer))
	if($("#right_panel").length > 0)
	{
		if($("#content").height() > $("#right_panel").height())
		{
			$("#footer").css('top', ($("#content").height() + 350) + "px");
			$("#right_panel").height($("#content").height() + 200);
		}
		else
		{
			$("#footer").css('top', ($("#right_panel").height() + 150) + "px");
			$("#content").height($("#right_panel").height());
		}
		$("#footer").show();
	}
	@else
		$("#footer2").css('top', ($("#body").height() + 150) + "px");
		$("#footer2").show();
	@endif
}

@if(!is_null($up_not))
var show_up_time = window.setTimeout('showUpNot()', 2000);
function showUpNot()
{
	$("#up_note").slideDown('slow');
	$("#up_note > .close").click(function()
	{
		$("#up_note").slideUp('slow');
	});
}
@endif

</script>