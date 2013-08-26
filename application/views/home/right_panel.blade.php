<div id="right_panel">
	<div class="section" id="mem_info">
		<div>
			<A href="{{ Auth::user()->profile() }}"><img src="{{ Auth::user()->img('_th') }}" /></a>
			<span class="mem_name"><a href="{{ Auth::user()->profile() }}">{{ Auth::user()->name() }}</a></span>
			&nbsp &nbsp &nbsp <span><b>{{ count(Message::new_messages()) }}</b> Messages</span>
		</div>
	</div>
	<div class="clr"></div>

	<hr />

	<div class="section" id="add_sheet">
		<h2>Add New Sheet</h2>
		<form action="{{ URL::to('home/add_sheet') }}" method="post" enctype="multipart/form-data" id="sheet_form" class="form">
			<div class="row"><div class="label">Material : <span>*</span></div>
				<select name="material_id" id="sheet_material_id" class="slct chzn-select" data-placeholder="Select Material...">
					<option value=""></option> 
					@foreach($materials as $material)
						<option value="{{ $material->id }}">{{ $material->name }}</option>
					@endforeach
				</select></div>
			<div class="row"><div class="label">Sheet name : <span></span></div><input class="nr_txt" type="text" name="name" id="sheet_name" /></div>
			<div class="row"><div class="label">Deliver at : <span>*</span></div><input class="date_picker nr_txt" type="text" name="deliver_at" id="sheet_deliver_at" /></div>
			<div class="row"><div class="label">Upload Sheet : </div><input class="file" type="file" name="file" id="sheet_file" /></div>
			<div class="row"><div class="label">Or Download URL : </div><input type="text" class="nr_txt" name="url" id="sheet_url" /></div>
			<input type="submit" id="sheet_submit" value="Add Sheet" class="sbmt" />
		</form>
	</div>

	<hr />

	<div class="section" id="edit_lecture">
		<h2>Lecture Canceled</h2>
		<form action="{{ URL::to('home/update_lecture') }}" method="post" id="lecture_form" class="form">
			<div class="row" style="text-align:center;">
				<input type="radio" name="type" id="lecture_type_lecture" value="lecture" checked="checked" />Lecture
				<input type="radio" name="type" id="lecture_type_section" value="section" />Section
			</div>
			<div class="row">
				<div class="label" id="lecture_name_label">Lecture name :<span>*</span></div>
				<select class="slct chzn-select" name="material_id" id="lecture_material_id" data-placeholder="Select Material...">
					<option valye=""></option>
					@foreach($materials as $material)
						<option value="{{ $material->id }}">{{ $material->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="row"><div class="label">Lecture Date : <span>*</span></div><input class="date_picker nr_txt" type="text" name="canceled_date" id="lecture_canceled_date" /></div>
			<div class="row"><div class="label">State : <span>*</span></div>
				<select class="slct chzn-select" name="state" id="lecture_state" data-placeholder="Select a Lecture...">
					<option value="">Normal</option>
					<option value="canceled">Canceled</option>
					<!-- <option value="delayed">Delayed</option> -->
				</select></div>
			<!--<div style="display:none;" class="row delayed_rows">
				<div class="label">New Date : <span>*</span></div>
				<input type="text" class="nr_txt date_picker" name="delayed_date" id="lecture_delayed_date" />
			</div>
			<div style="display:none;" class="row delayed_rows">
				<div class="label">New Time : <span>*</span></div>
				<input type="text" class="time_txt" name="delayed_start_at" title="start at" id="lecture_start_at" /> &nbsp <input class="time_txt" type="text" name="delayed_end_at" title="end at" id="lecture_end_at" /> <small>ex: 8.30</small>
			</div>
			<div style="display:none;" class="row delayed_rows">
				<input type="checkbox" name="overwrite" id="lecture_overwrite" /> &nbsp Overwrite any lectures at the same time
			</div>-->
			<input class="sbmt" type="submit" id="s_submit" value="Update Lecture State" />
		</form>
	</div>

	<hr />

	<div class="section" id="edit_lecture">
		<h2>Upload Document</h2>
		<form action="{{ URL::to('home/add_document') }}" class="form" method="post" id="document_form">
			<div class="row"><div class="label">Material : <span>*</span></div>
				<select class="slct chzn-select" data-placeholder="Select Material..." name="material_id" id="document_material_id" >
					<option value=""></option>
					@foreach($materials as $material)
						<option value="{{ $material->id }}">{{ $material->name }}</option>
					@endforeach
				</select></div>
			<div class="row">
				<div class="label">Document title: <span>*</span></div>
				<input type="text" class="nr_txt" name="name" id="document_name" />
			</div>
			<div class="row"><div class="label">Download URL : <span>*</span></div><input type="text" class="nr_txt" name="url" id="document_url" /></div>
			<div class="row"><a class="link" href="{{ URL::to('upload') }}" target="_blank">Or Upload Document ?</a></div>
			<input class="sbmt" type="submit" id="s_submit" value="Upload Document" />
		</form>
	</div>

	<hr />

	<div class="section" id="online_members">
		<h2>Online Members</h2>
		<div class="online_members">
			@if(empty($online_members))
				There are no online members in your group
			@endif
			@foreach($online_members as $online_member)
				<div class="online_member">
					<a href="{{ $online_member->profile() }}">
						<img title="{{ $online_member->name() }}" src="{{ $online_member->img('_th') }}">
					</a>
				</div>
			@endforeach

		</div>
		<div class="clr"></div>
	</div>

	<hr />

</div><!-- END #right_panel -->