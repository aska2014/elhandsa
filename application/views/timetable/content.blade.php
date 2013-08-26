<div id="big_content">
	@if(!isset($display) && !is_null($days) && !empty($days))
		<a class="blue_btn" href="{{ URL::to('timetable/update') }}">Update timetable from here</a>
	@endif
	<div id="colors_mean">
		<div class="c_m">
			<div id="blue"></div><span>Section</span>
		</div>
		<div class="c_m">
			<div id="grey"></div><span>Lecture</span>
		</div>
		<div class="c_m">
			<div id="red"></div><span>Canceled</span>
		</div>
	</div>
	<div class="clr"></div>

	
	<div style="color:#900; text-align:center; margin-top:60px;">
		@if(is_null($days) || empty($days))
			The timetable hasn't been added yet in this group.<br />
			<b style="color:#333;"><a href="{{ URL::to('timetable/update') }}">Click here to add one</a></b><br />
			<b style="color:#900;"><a href="https://www.youtube.com/watch?v=YmTuznyJmBM" target="_blank">Or click here to watch a video on how to add one</a></b>
		@endif
	</div>
	@if(!is_null($days) && !empty($days))
	<div id="timeline"></div>
	@endif

	<div id="timetable">
		{{ echoHTML::echo_timetable($days) }}
	</div><!-- END #timetable -->
	<div class="clr"></div>
</div>