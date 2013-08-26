<script type="text/javascript">

$(document).ready(function()
{
	scrollConversation();
});

window.setInterval('checkNewMessage()', 1000);

function checkNewMessage()
{
	$.ajax({
		cache:false,
		url: "{{ URL::to('conversations/return_new/'.$to_member->id) }}",
		type: "GET",
		success:function(d)
		{
			if(d.length > 10)
			{
				$("#message_container").append(d);
				scrollConversation();
			}
		}
	});

}

function scrollConversation(){
	var objDiv = document.getElementById("message_container");
	objDiv.scrollTop = objDiv.scrollHeight;	
}

function conversationResponse(response_text, $form) 
{
	$("#message_container").append(response_text);
	$("#message_body").val('');
	scrollConversation();
	updateView();
}

</script>