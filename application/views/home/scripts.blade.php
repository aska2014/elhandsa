<!-- SELECT PLUGIN -->
<script type="text/javascript"> 

$(document).ready(function()
{$("#comment_form > .txt").focus(function(){$(this).next('.sbmt').css('display','inline');});$("#comment_form > .txt").blur(function(){$(this).next('.sbmt').delay(200).hide('fast');});$(".view_all").click(function()
{$(this).parent().hide('slow',updateView);$("#post"+$(this).attr('id')).find('.comment').show();});$(".post").hover(function()
{$(this).find('.delete').show();},function()
{$(this).find('.delete').hide();});$(".complete").hover(function()
{$(this).find('.close').show();},function()
{$(this).find('.close').hide();});$(".close").click(function(){setCookie($(this).next('#not_type').val() + "_not", $(this).next('#not_type').next('#not_id').val(), 5, '/'); $(this).parent().hide('slow');});
$(".delete").click(function(){var answer=confirm("Press 'OK' to delete this post");if(answer)
{var post_id=$(this).attr('id').replace("delete","");$.ajax({cache:false,url:'{{ URL::to("home/delete_comment") }}',type:'POST',data:'post_id='+post_id,success:function(data)
{if(data.indexOf('success')>-1)
{$("#post"+data.replace("success","")).slideUp('slow');}}});}});$("#lecture_form").find("input:radio").on('change',function()
{if($(this).val()=="lecture")
{$("#lecture_day_label").html('Lecture day : <span>*</span>');$("#lecture_name_label").html('Lecture name : <span>*</span>');}
else
{$("#lecture_day_label").html('Section day : <span>*</span>');$("#lecture_name_label").html('Section name : <span>*</span>');}});$(".like_btn").click(function()
{var post_id=$(this).attr('id');post_id=post_id.replace("like","");$.ajax({cache:false,url:"{{ URL::to('home/likePost/') }}",data:{post_id:post_id},type:"POST",success:function(d)
{if(d.indexOf("success")>-1)
{var p_id=d.replace("success","");if($("#show_likes"+p_id).length==0)
{$("#comments"+p_id).prepend('<div class="comment" id="post_likes"><span>1</span> people like this</div>');}
else
{$("#show_likes"+p_id+" > span").html(parseInt($("#show_likes"+p_id+" > span").html())+1);}}}});return false;});$(".show_likes").hover(function()
{var position=$(this).position();$(".members_show_likes").hide();$("#members_"+$(this).attr('id')).css({'top':position.top+($(this).height()/2),'left':position.left+($(this).width()/2)})
$("#members_"+$(this).attr('id')).css('display','inline');},function()
{$("#members_"+$(this).attr('id')).css('display','none');});});function homeResponse(response_text,$form)
{if($form.attr('id')=="post_form")
{$form[0].reset();$("#posts").prepend(response_text);$(".post").first().show('slow',updateView);updateForms();}
else if($form.attr('id')=="comment_form")
{$form[0].reset();$form.before(response_text);$form.parent().find(".comment").last().show('slow',updateView);}
else if($form.attr('id')=="sheet_form"||$form.attr('id')=="lecture_form"||$form.attr('id')=="document_form")
{if(response_text.indexOf('success')>-1)
{$form[0].reset();$form.before('<div class="success">The task has been done successfully</div>');response_text=response_text.replace("success","");if(response_text.length>2)
$form.before('<div class="notes">'+response_text+'</div>');}
else
{$form.before('<div class="error">'+response_text+'</div>')}}
updateView();}
window.setInterval('checkNewPost()',5000);function checkNewPost()
{var last_post=$(".post").first().attr('id');last_post=last_post.replace("post","");$.ajax({cache:false,url:"{{ URL::to('home/checkPost/') }}"+last_post+"/{{ $posts_type }}",type:"POST",success:function(d)
{if(d.length>10)
{$("#posts").prepend(d);$(".post").first().show('slow',updateView);updateForms();updateView();}}});}



</script>

{{ HTML::style('public/plugins/chosen/chosen.css') }}
{{ HTML::script('public/plugins/chosen/chosen.jquery.min.js') }}

<!-- DATE PICKER PLUGIN -->
{{ HTML::style('public/plugins/date_picker/css/jquery.ui.all.css') }}
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
{{ HTML::script('public/plugins/date_picker/js/jquery.ui.widget.js') }}
{{ HTML::script('public/plugins/date_picker/js/jquery.ui.datepicker.js') }}

<script>
$(".chzn-select").chosen(); 
$(".chzn-select-deselect").chosen({allow_single_deselect:true});
$(function() {
	$( ".date_picker" ).datepicker();
});
</script>