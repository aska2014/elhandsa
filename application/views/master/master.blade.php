<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><? if(isset($title))echo $title; else echo 'EL-Handsa'; ?></title>
	<noscript>
  		<meta http-equiv="refresh" content="0;url={{ URL::to('help/enable_javascript') }}">
	</noscript>
	<link rel="icon" href="{{ URL::to('public/img/favicon.ico') }}" type="image/x-icon">
	<link rel="shortcut icon" href="{{ URL::to('public/img/favicon.ico') }}" type="image/x-icon"> 
	{{  HTML::style('public/css/master.css') }}
	@yield('styles')
</head>
<body>

@if(!$seen_help)
<a id="need_help" href="{{ URL::to('help/videos') }}">Need help? Click here <br />To watch videos on <br />How-to</a>
@endif

@if(!is_null($up_not))
<div id="up_note">
	<b>{{ $up_not->title }}</b>
	 {{ $up_not->body }}
	 <a class="close"></a>
</div>
@endif


<div id="menu_bg"></div>
<div id="Container">
	<div id="header">
		<a href="{{ URL::base() }}"><div id="logo"></div></a>
		<div id="menu">
			<ul>
				<li><a<? if($menu_active == "home")      echo ' class="active"'; ?> href=" {{ URL::base() }}"         >Home</a></li>
				<li><a<? if($menu_active == "members")   echo ' class="active"'; ?> href="{{ URL::to('members') }}"   >Members</a></li>
				<li><a<? if($menu_active == "timetable") echo ' class="active"'; ?> href="{{ URL::to('timetable') }}" >Time Table <? if($timetable_not) echo '<sup style="color:#F00">NEW</sup>'  ?></a></li>
				<li><a<? if($menu_active == "sheets")    echo ' class="active"'; ?> href="{{ URL::to('sheets') }}"    >Sheets     <? if($sheet_not) echo '<sup style="color:#F00">NEW</sup>'  ?></a></li>
				<li><a<? if($menu_active == "documents") echo ' class="active"'; ?> href="{{ URL::to('documents') }}" >Documents  <? if($document_not) echo '<sup style="color:#F00">NEW</sup>'  ?></a></li>
				<li>
					<a<? if($menu_active == "profile")   echo ' class="active"'; ?> href="{{ Auth::user()->profile() }}">Profile</a>
					<a href="javascript:void(0)" id="profiledropdown"<? if($messages_not > 0) echo ' style="color:#F00;"' ?>>▼</a>
				</li>
			</ul>
		</div><!-- END #menu -->
		<div class="dropdownheaderdiv">
			<ul class="dropdownheader" <? if($messages_not > 0) echo 'style="display:block"'; ?>>
				<li><a href="{{ URL::to('profile/edit') }}">Edit Profile</a></li>

				@if($messages_not > 0)
					<li><a href="{{ URL::to('conversations') }}">Conversations <sup>({{ $messages_not }})</sup></a></li>
				@else
					<li><a href="{{ URL::to('conversations') }}">Conversations</a></li>
				@endif

				<li><a href="{{ URL::to('logout') }}">Logout</a></li>
			</ul>
		</div>

	</div><!-- END #header -->
	<div class="clr"></div>
	<div id="body">
		@yield('content')
	</div><!-- END #body -->
	<div class="clr"></div>
	@if(isset($footer))
		<div id="footer">
			Copyright (c) EL-Handsa PortSaid 2012 All Rights Reserved
			<ul>
				<li><a href="{{ URL::home() }}">Home</a></li>
				<li><a href="{{ URL::to('contact') }}">Send Suggestions</a></li>
				<li><a href="{{ URL::to('help/videos') }}">Help</a></li>
				<li><a href="{{ URL::to('help/faq') }}">FAQ</a></li>
			</ul> 
		</div>
	@else
		<div id="footer2" style="display:none">
			<ul>
				<li><a href="{{ URL::home() }}">Home</a></li>
				<li><a href="{{ URL::to('contact') }}">Send Suggestions</a></li>
				<li><a href="{{ URL::to('help/videos') }}">Help</a></li>
				<li><a href="{{ URL::to('help/faq') }}">FAQ</a></li>
			</ul> 
		</div>
	@endif

</div><!-- END #Container -->


<!-- MAIN SCRIPTS -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

@include('master.scripts')
@yield('scripts')

</body>
</html>