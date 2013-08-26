<div id="timetable_edit">
	@if($step == 1)
		<form action="{{ URL::to('timetable/update') }}" id="timetable_form" method="POST">
			<h2>Week</h2>
			<div class="error">{{ echoHTML::echo_errors($errors) }}</div>
			<div class="small"></div>
			<div class="row">
				<div class="label">Start at : <span>*</span></div>
				<select id="timetable_start_at" name="start_at" class="slct chzn-select" data-placeholder="Select day...">
					<option value=""></option>
					@foreach($days as $day)
						@if($timetable->days_start_at == $day)
							<option value="{{ $day }}" selected="selected">{{ $day }}</option>
						@else
							<option value="{{ $day }}">{{ $day }}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="row">
				<div class="label">End at : <span>*</span></div>
				<select id="timetable_end_at" name="end_at" class="slct chzn-select" data-placeholder="Select day...">
					<option value=""></option>
					@foreach($days as $day)
						@if($timetable->days_end_at == $day)
							<option value="{{ $day }}" selected="selected">{{ $day }}</option>
						@else
							<option value="{{ $day }}">{{ $day }}</option>
						@endif
					@endforeach
				</select>
			</div>
			<input type="submit" value="Continue ►" class="sbmt" id="profile_submit" />
		</form>
	@elseif($step == 2)
		<h2>{{ $day }}</h2>
		<form action="{{ URL::to('timetable/update_day/'.$day) }}" id="timetable_form" method="POST" class="form">
			
			<div class="small"></div>
			<div class="row" style="text-align:center;">
				<input type="radio" name="type" id="timetable_type_lecture" value="lecture" checked="checked" />Lecture
				<input type="radio" name="type" id="timetable_type_section" value="section" />Section
			</div>
			<div class="row">
				<div class="label">Material : <span>*</span></div>
				<select id="timetable_material_id" name="material_id" class="slct chzn-select" data-placeholder="Select material...">
					<option value=""></option>
					@foreach($materials as $material)
						<option value="{{ $material->id }}">{{ $material->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="row" id="timetable_time_row">
				<div class="label">Time : <span>*</span></div>
				<input type="text" class="time_txt" name="start_at" id="timetable_start_at" value="start at" onfocus="if(this.value == 'start at')this.value='';" onblur="if(this.value == '')this.value = 'start at';" /> &nbsp 
				<input type="text" class="time_txt" name="end_at" id="timetable_end_at" value="end at" onfocus="if(this.value == 'end at')this.value='';" onblur="if(this.value == '')this.value = 'end at';" /> <small>ex: 8.30</small>
			</div>
			<div class="row" id="timetable_time_row">
				<div class="label">Place : <span>*</span></div>
				<input type="text" class="time_txt" name="place" id="timetable_place"/>&nbsp <small>ex: 511</small>
			</div>
			<div class="clr"></div>
			<div class="row">
				<input type="checkbox" name="overwrite" value="yes" /> Overwrite any lectures at the same time
			</div>
			<input type="hidden" name="day" value = "{{ $day }}" />
			<input type="submit" value="Add new lecture in {{ $day }}" style="width:250px; margin-left:30px;" class="sbmt" id="timetable_submit" />
			@if($days[0] != $day)
				<input type="button" onclick="javascript:window.location.href = '{{ URL::to('timetable/update_day/'.$day.'/-1') }}#timetable_form'" value="Go to prev day" class="sbmt" style="width: 120px; float:left; margin-left:30px;" />
			@endif
			@if($days[ count($days) - 1 ] != $day)
				<input type="button" onclick="javascript:window.location.href = '{{ URL::to('timetable/update_day/'.$day.'/1') }}#timetable_form'" value="Go to next day" class="sbmt" style="width: 120px; float:right; margin-left:0px; margin-right:20px;" />
			@endif
		</form>
	@endif
	<div class="clr"></div>
</div>