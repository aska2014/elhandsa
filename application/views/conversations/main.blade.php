
<div id="members">

	<select style="width:200px;" class="slct chzn-select" name="members_type" id="members_type" data-placeholder="Select Material...">
		<option value="students" selected="selected">Students</option>
		<option value="instructors">Instructors</option>
	</select>
	<div class="clr" style="margin-bottom:24px;"></div>
	<hr />

	<div id="users">
		{{ echoHTML::echo_conversation_members_list($members) }}
	</div>

</div>

<div id="conversations">
	@if(empty($conversations))
		<div class="no_exist">
			<small>
				There is no conversation between you and any member yet.<br />
				<b style="color:#333;">Start a conversation from the left list</b>
			</small>
		</div>
	@endif
	@foreach((array)$conversations as $conversation)
	<div class="message"<? if(!$conversation->seen())echo ' style="background:#EEE"' ?> onclick="javascript:window.location.href = '{{ URL::to('conversation/'.$conversation->other_member()->name_url()) }}'">
		<div class="img">
			<a href="{{ $conversation->other_member()->profile() }}">
				<img src="{{ $conversation->other_member()->img() }}" />
			</a>
		</div>
		<div class="message_info" style="width:560px">
			<div class="mem_name"><A href="{{ $conversation->other_member()->profile() }}">{{ $conversation->other_member()->name() }}</a> <sup style="color:#F00"><? if(!$conversation->seen()) echo 'NEW' ?></sup></div>
			<div class="tools">
				<span class="date">{{date('j F, g:i a', strtotime($conversation->created_at))}}</span>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
	<Hr />
	<div class="clr"></div>
	@endforeach
</div>

<style type="text/css">

.message:hover{ background:#EEE; cursor: pointer; }

</style>