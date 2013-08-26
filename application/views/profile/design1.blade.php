<div id="profile">
	<div id="mem_name">	
		<div id="first_name">{{ $member->first_name }}</div>
		<div id="last_name">{{ $member->last_name }}</div> <!-- first name less than 10 and Last name less than 9 characters -->
	</div>
	<div class="clr"></div>
	<div id="mem_desc">
		<div id="img_holder">
			<div id="mem_img">
				<img src="{{ $member->img() }}" />
			</div>
		</div>
		@if(($member->id == Auth::user()->id && strlen($member->status) < 5) || $change_status)
			<form id="about_form" action="{{ URL::to('profile/update_status') }}" method="POST">
				<textarea id="about_status" name="status" class="txt" style="height:100px;" onfocus="if(this.value == 'Share a status...')this.value = '';" onblur="if(this.value == '')this.value = 'Share a status...'">Share a status...</textarea><Br />
				<input type="submit" class="sbmt" value="Update Status" />
				@if($change_status)
					<a style="color:#900; font-size:12px;" href="{{ $member->profile() }}">Skip</a>
				@endif
			</form>
		@else
		<p>
			{{ $member->status }}
		</p>
			@if($member->id == Auth::user()->id)
				<a href="{{ $member->profile().'?change_status=true' }}" style="float:right; color:#900; margin-top:5px; font-size:12px;">Change Status?</a>
			@endif
		@endif
		@if($member->id != Auth::user()->id)
			<div class="clr"></div>
			<a class="blue_btn" href="{{ URL::to('conversation/'.$member->name_url()) }}" style="float:left; margin-left:20px;">Start a conversation</a>
		@endif
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
<!-- 	<div id="recent_activites" class="p_section">
		<h2>Recent Activites</h2>
		<div class="activity">
			<div class="desc">Finished Sheet Graphics</div>
			<div class="date">Tuesday 08:32</div>
		</div>
		<div class="activity">
			<div class="desc">Finished Sheet Graphics</div>
			<div class="date">Tuesday 08:32</div>
		</div>
		<div class="activity">
			<div class="desc">Finished Sheet Graphics</div>
			<div class="date">Tuesday 08:32</div>
		</div>
	</div> -->
	<div id="student_info" class="p_section">
		@if($member->id == Auth::user()->id)
		<a class="blue_btn" href="{{ URL::to('profile/edit') }}">Edit your Info</a>
		@endif

		<h2>Student Info</h2>
		@if($member->cell_phone != '')
		<div class="activity">
				<div class="title">Cell Phone: </div>
				<div class="info">{{ $member->cell_phone }}</div>
		</div>
		@endif
		@if($member->home_town != '')
		<div class="activity">
			<div class="title">Home Town: </div>
			<div class="info">{{ $member->home_town }}</div>
		</div>
		@endif
		@if($member->birthday())
		<div class="activity">
			<div class="title">Birthday: </div>
			<div class="info">{{ $member->birthday() }}</div>
		</div>
		@endif
		@if($member->hoppies)
		<div class="activity">
			<div class="title">Hoppies: </div>
			<div class="info">{{ $member->hoppies }}</div>
		</div>
		@endif
	</div>
	<div id="student_info" class="p_section">
		@if($member->about)
		<div class="activity">
			<div class="title">About: </div>
			<div class="info">{{ $member->about }}</div>
		</div>
		@endif
	</div>

</div>