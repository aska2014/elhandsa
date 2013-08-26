@layout('master.master1')


@section('content')

<div id="forms_container">
	<form action="" id="doctors_form" method="POST">
		<div class="forms register" style="width:350px;">
			<h2>Adding {{ $instructor_who }}</h2>
			<small><B style="color:#FF6">{{ $instructor_who }} name in Arabic</b></small>
			<div class="error">{{ echoHTML::echo_errors($errors) }}</div>
			<div class="row">
				<input type="text" dir="rtl" style="float:left;" name="instructor_name" id="d_instructor_name" class="txt" />
				<div class="label" style="float:right; font-size:20px;">أسم {{ $instructor_who_arabic }}</div>
			</div>
			<div class="clr"></div>
			<input type="submit" id="sbmt2" class="sbmt" style="margin-right:100px" Value="Add {{ $instructor_who }}" />
			</div>
		</div>
	</form>
</div>

@endsection