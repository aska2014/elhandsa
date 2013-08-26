<div>
<a href="{{ URL::home() }}"><div id='r_logo'></div></a>
	<div id="steps_words">
		<div>Step 1: Registering</div>
		<div>Step 2: Basic Information</div>
		<div>Step 3: Adding materials</div>
	</div>
	<div class="clr"></div>
	<div id="steps">
		<div id="l_step1"></div>
		<div id="l_step2"></div>
		<div id="l_step3"></div>
	</div>

	<div class="clr"></div>
	
	<div id="forms_container">
	<form action="" id="login_form" method="POST" enctype="multipart/form-data">
		<div id="step1" class="forms register">
		<h2>Register</h2>
		<div class="error">{{ echoHTML::echo_errors($errors) }}</div>
			<div class="row">
				<div class="label">Email : </div>
				<input type="text" title="Email Address" name="email" id="r_email" class="txt" />
			</div>
			<div class="clr"></div>
			<div class="row">
				<div class="label">First name : </div>
				<input type="text" title="First name" name="first_name" id="r_first_name" class="txt" />
			</div>
			<div class="clr"></div>
			<div class="row">
				<div class="label">Last name : </div>
				<input type="text" title="Last name" name="last_name" id="r_last_name" class="txt" />
			</div>
			<div class="clr"></div>
			<div class="row">
				<div class="label">Password : </div>
				<input type="password" title="Password" name="password" id="r_password" class="txt" />
			</div>
			<div class="clr"></div>
			<div class="row">
				<div class="label">Year : </div>
				<select id="r_year" name="year" class="slct chzn-select" data-placeholder="Select year...">
					<option value=""></option>
					<option value="0">Preparatory</option>
					<option value="1">First Year</option>
					<option value="2">Second Year</option>
					<option value="3">Third Year</option>
					<option value="4">Fourth Year</option>
				</select>
			</div>
			<div class="clr"></div>
			<div class="row">
				<div class="label">Department : </div>
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
			</div>
			<div class="clr"></div>
			<div class="row">
				<div class="label"><small>Group Password : </small></div>
				<input type="password" title="Group Password" name="group_password" id="r_group_password" class="txt" />
			</div>
			<div class="clr"></div>
			<input type="submit" id="sbmt1" class="sbmt" Value="Next Step ►" />
		</div>

		<div id="step2" class="forms register">
			<h2>Student Info.</h2>
			<small>All the following Information will be shared with your group.<br />
			 <b>you can leave them empty for now.</b></small>
			<div class="row">
				<div class="label">Cell Phone : </div>
				<input type="text" title="Cell Phone" name="cell_phone" id="r_cell_phone" class="txt" />
			</div>
			<div class="clr"></div>
			<div class="row">
				<div class="label">Home Town : </div>
				<input type="text" title="Home Town" name="home_town" id="r_home_town" class="txt" />
			</div>
			<div class="clr"></div>
			<div class="row">
				<div class="label">Birthday : </div>
				<select id="r_birthday_month" name="birthday_month" class="chzn-select" data-placeholder="Month..." style="width:110px;">
					<option value=""></option>
					<option value="1">January</option>
			        <option value="2">February</option>
			        <option value="3">March</option>
			        <option value="4">April</option>
			        <option value="5">May</option>
			        <option value="6">June</option>
			        <option value="7">July</option>
			        <option value="8">August</option>
			        <option value="9">September</option>
			        <option value="10">October</option>
			        <option value="11">November</option>
			        <option value="12">December</option>
				</select>
				<select id="r_birthday_day" name="birthday_day" class="chzn-select" data-placeholder="Day..." style="width:110px;">
					<option value=""></option>
					@for($day = 1; $day <= 31; $day++)        
						<option value="{{$day}}">{{$day}}</option>
					@endfor
				</select>
			</div>
			<div class="clr"></div>
			<div class="row">
				<input type="checkbox" name="remember_me" id="remember_me" /><small>Remember me on this computer</small>
			</div>
			<div class="clr"></div>
			<input type="submit" id="sbmt2" class="sbmt" Value="Next Step ►" />
		</div>

<!-- 		<div id="step3" class="forms register">
			<h2>Profile Image</h2>
			<small>Upload an Image for your profile, the image should be less than 1MB.</small>
			<div class="row">
				<input type="file" class="file" title="Upload Image" name="r_img" id="r_img" />
			</div>
			<div class="clr"></div>
			<input type="submit" class="sbmt" id="sbmt3" Value="Finish Registering" />
		</div> -->
	</form>
	</div><!-- END of forms_container -->
</div>