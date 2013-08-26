@layout('master.master1')

@section('styles')
	{{ HTML::style('public/css/members.css') }}
@endsection

@section('content')

<div id="menu">
	<ul>
		<li><a href="{{ URL::home() }}">Home</a></li>
		<li><a href="{{ URL::to('members') }}" style="color:#4bc5f8">Members</a></li>
		<li><a href="{{ URL::to('timetable') }}">TimeTable</a></li>
		<li><a href="{{ URL::to('sheets') }}">Sheets</a></li>
		<li><a href="{{ URL::to('documents') }}">Documents</a></li>
		<li><a href="{{ URL::to('profile') }}">Profile</a></li>
	</ul>
</div>

<div class="clr"></div>

<div id="members">

	<div id="fb-right">
		<div class="fb-like" data-href="http://www.elhandsa.com/" data-send="true" data-layout="button_count" data-width="450" data-show-faces="false"></div>
	</div>

	<a href="{{ URL::home() }}"><div id="logo"></div></a>

	<h1>Members in <span>{{ Auth::user()->group->year() }} Year</span></h1>

	<div class="clr"></div>
	@foreach($groups as $group)
	<div class="group">
		<div class="group_title">{{ $group->name() }}</div>
		<div class="group_members">
			@if(empty($group->members))
				<div class="n_error">No members in this group yet</div>
			@endif
			<? $i = 0; ?>
			@foreach($group->members as $member)
			<? if($i > 11)break; $i ++; ?>
			<div class="member" title="{{ $member->name() }}">
				<div class="img">
					<a href="{{ $member->profile() }}">
						<img src="{{ $member->img('_th') }}" />
					</a>
				</div>
			</div>
			@endforeach
			<div class="member_invite_button">
				<div id="fb-root"></div>
				<a href='#' onclick="FacebookInviteFriends();">
					Invite Friends
				</a>
			</div>
		</div>
	</div>
	@endforeach

	<div class="member_invite"><div class="invite_button"></div></div>

</div>

<div class="clr"></div>

<div id="footer2">
	<ul>
		<li><a href="{{ URL::home() }}">Home</a></li>
		<li><a href="{{ URL::to('timetable') }}">TimeTable</a></li>
		<li><a href="{{ URL::to('sheets') }}">Sheets</a></li>
		<li><a href="{{ URL::to('documents') }}">Documents</a></li>
		<li><a href="{{ URL::to('profile') }}">Profile</a></li>
	</ul> 
</div>

@endsection

@section('scripts')

<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
	FB.init({
		appId:'544011608946735',
		cookie:true,
		status:true,
		xfbml:true
	});

	function FacebookInviteFriends()
	{
		FB.ui({
		method: 'apprequests',
		message: 'Your Message diaolog'
		});
	}
</script>

@endsection