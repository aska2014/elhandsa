<!-- SELECT PLUGIN -->
{{ HTML::style('public/plugins/chosen/chosen.css') }}
{{ HTML::script('public/plugins/chosen/chosen.jquery.min.js') }}
<script type="text/javascript">

$(document).ready(function()
{
	$(".box").live('click', function()
	{
		var position = $(this).position();
		$(".box_info").hide();
		$(this).next('.box_info').css({ 'top' : position.top + ($(this).height() / 2), 'left' : position.left + ($(this).width() / 8) })
		$(this).next('.box_info').slideDown('fast');
	});
	$(".delete").live('click', function()
	{
		$(this).parent().slideUp('fast');
	});

	//Deleting lecture
	$(".delete_row").live('click', function(){
		var answer = confirm("Press 'OK' to " + $(this).find(".delete_label").html());
		if(answer)
		{
			var lecture_id = $(this).attr('id').replace("delete","");
			$.ajax({
				cache:false,
				url:  '{{ URL::to("timetable/delete_lecture") }}', 
				type: 'POST',
				data: 'lecture_id=' + lecture_id,
				success:function(data)
				{
					if(data.indexOf('success') > -1)
					{
						var l_id = data.replace("success", "");
						$("#lecture" + l_id).next(".box_info").remove();
						$("#lecture" + l_id + " > h2").remove();
						$("#lecture" + l_id + " > .time").remove();
						$("#lecture" + l_id).css({'background' : '#F5F5F5', 'border':'1px solid #F5F5F5', 'cursor':'default'});
					}
				}
			});
		}
	});
});
$(".chzn-select").chosen(); 
$(".chzn-select-deselect").chosen({allow_single_deselect:true});

function timetableResponse(response_text, $form)
{
	if(response_text.indexOf('success') > -1)
	{
		$form.before('<div class="success">The task has been done successfully</div>');
		response_text = response_text.replace("success", "");
		$("#timetable").html(response_text);
		$("#timetable_end_at").val(''); $("#timetable_start_at").val(''); $("#timetable_place").val('');
	}
	else
	{
		$form.before('<div class="error">' + response_text + '</div>')
	}
	updateView();
}

</script>