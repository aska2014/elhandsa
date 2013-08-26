
<div id="members">

	<select style="width:200px;" class="slct chzn-select" name="members_type" id="members_type" data-placeholder="Select Material...">
		<option value="students" selected="selected">Chat with Students</option>
		<option value="instructors">Chat with Instructors</option>
	</select>
	<div class="clr" style="margin-bottom:24px;"></div>
	<hr />

	<div id="users">
		{{ echoHTML::echo_conversation_members_list($members) }}
	</div>

</div>

<div id="conversation">

	<div id="message_container">
		@foreach($messages as $message)
		<div class="message">
			<div class="img">
				<a href="{{ $message->member->profile() }}">
					<img src="{{ $message->member->img() }}" />
				</a>
			</div>
			<div class="message_info">
				<div class="mem_name"><A href="{{ $message->member->profile() }}">{{ $message->member->name() }}</a></div>
				<div class="post_body">{{ $message->body }}</div>
				<div class="tools">
					<span class="date">{{ $message->date() }}</span>
				</div>
			</div>
		</div>
		<div class="clr"></div>
		<Hr />
		<div class="clr"></div>
		@endforeach
	</div>

	<form action="{{ URL::to('conversations/add_message') }}" id="message_form" class="form" method="POST">
		<textarea class="txt" name="body" id="message_body" ></textarea><Br />
		<input type="submit" class="sbmt" value="Send Message" />
		<input type="hidden" name="to_id" value="{{ Hash::encode($to_member->id) }}" />
	</form>

</div>