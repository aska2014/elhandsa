@layout('master.master1')

@section('content')

<style type="text/css">

#form_container{font-size:14px; width:350px; margin:0px auto; margin-top:160px; text-align:left; }
#form_container h1{margin-bottom:40px; color:#FFF; text-align: center;}
#form_container small{color:#FFF; font-size:14px; position:relative; bottom:2px;}
#form_container .slct{width:200px; float:left; color:#333;}
#form_container .sbmt{cursor:pointer; box-shadow:0px 0px 10px #222; background:#f25050; border:1px solid #6b3131; padding:3px 5px; color:#FFF; font-family: Tahoma, Arial; font-size:18px; margin-top:10px;}


</style>
	{{ echoHTML::echo_errors($errors) }}
	<div id="form_container">
	<h1>Select Group</h1>
		<form action="{{ URL::to('group/choose') }}" method="POST">
			<select id="r_year" name="year" class="slct chzn-select" data-placeholder="Select year..." style="width:130px">
				<option value=""></option>
				<option value="0">Preparatory</option>
				<option value="1">First Year</option>
				<option value="2">Second Year</option>
				<option value="3">Third Year</option>
				<option value="4">Fourth Year</option>
			</select>

			<select id="r_department" name="department" class="slct chzn-select" data-placeholder="Select department...">
				<option value=""></option>
				@foreach($departments as $department)
					<option value="{{ $department->department }}">{{ $department->department_ar }}</option>
				@endforeach
			</select>

			<select id="r_preparatory_department" name="preparatory_department" class="slct chzn-select" data-placeholder="Select department...">
				<option value=""></option>
				@foreach($preparatory_departments as $department)
					<option value="{{ $department->department }}">{{ $department->department_ar }}</option>
				@endforeach
			</select>
			<div class="clr"></div><br />

			<input type="checkbox" name="save_selection" value="yes" /> <small>Remember my selection</small><Br />
			<input type="submit" value="Submit" class="sbmt" />
		</form>
	</div>



@endsection

@section('scripts')

{{ HTML::style('public/plugins/chosen/chosen.css') }}
{{ HTML::script('public/plugins/chosen/chosen.jquery.min.js') }}

<script type="text/javascript">
	
	$(document).ready(function()
	{

		if($("#r_year").val() == "0")
		{
			$("#r_department_chzn").hide();
			$("#r_preparatory_department_chzn").show();
		}
		else
		{
			$("#r_preparatory_department_chzn").hide();
			$("#r_department_chzn").show();
		}
		$("#r_year").change(function()
		{
			if($(this).val() == "0")
			{
				$("#r_department_chzn").hide();
				$("#r_preparatory_department_chzn").show();
			}
			else
			{
				$("#r_preparatory_department_chzn").hide();
				$("#r_department_chzn").show();
			}
		});
	});

	$(".chzn-select").chosen();
	$(".chzn-select-deselect").chosen({allow_single_deselect:true}); 

</script>

@endsection