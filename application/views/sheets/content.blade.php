<div id="big_content">


	@if(empty($sheets))
		<div class="no_exist">No sheets have been uploaded yet</div>
	@else
		<div id="colors_mean">
			<div class="c_m">
				<div id="blue"></div><span>Current Sheets</span>
			</div>
		</div>
		<table id="table" cellspacing="0">
			<tr class="titles">
				<td width="25%">Lecture</td>
				<td width="25%">Sheet name</td>
				<td width="25%">Deliver date</td>
				<td width="25%">Download</td>
			</tr>
			@foreach($sheets as $sheet)
			<tr <? if($sheet->current())echo 'class="current"' ?>>
				<td class="lecture_name">{{ $sheet->material->name }}</td>
				<td class="sheet_name">{{ $sheet->name }}</td>
				<td class="date">{{ date('d F',strtotime($sheet->deliver_at)) }}</td>
				<td class="download"><a href="{{ $sheet->file_url }}" target="_blank">Download</a></td>
			</tr>
			@endforeach
		</table>
	@endif
</div>