<div>
<a href="{{ URL::home() }}"><div id='r_logo'></div></a>
	<div id="steps_words">
		<div>Step 1</div>
		<div>Step 2</div>
		<div>Step 3</div>
	</div>
	<div class="clr"></div>
	<div id="steps">
		<div id="l_step1"></div>
		<div id="l_step2"></div>
		<div id="l_step3"></div>
	</div>
	<div class="clr"></div>
	<div id="forms_container">
	<form action="" id="login_form" method="POST" enctype="multipart/form-data" style="position:relative">
		<div id="step1" class="forms register">
			<h2>Choose Doctor</h2>
			<div class="error"><?php echo implode("<br />" ,$errors->all()) ?></div>
			<div class="row">
				<div class="label">Doctor name : </div>
				<select name="doctor_id" id="doctor_id" class="slct chzn-select" data-placeholder="Select ...">
					@foreach($doctors as $doctor)
						<option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="clr"></div>
			<div class="row">
				<font color="#FFF" size="2">
					Can't find your name?<br />Please send us a message <a href="#" style="color:#F25050">from here</a>
				</font>
			</div>
			<div class="clr"></div>
			<input type="submit" id="d_sbmt1" class="d_sbmt" Value="Next Step ►" />
		</div><!-- END of step1 -->

		<div id="step2" class="forms register" style="margin-top:0px;">
			<h2>Doctor Info.</h2>
			<div class="error"></div>
			<small style="color:#CCC">Select Materials you teach and write something about you.<br />
				   This info. will be shared with the students.</small><Br /><Br/>
			<div class="row">
				<div class="label" style="width:80px;">Materials : </div>
		        <select style="width:250px" id="materials" name="materials" data-placeholder="Choose multiple materials" multiple class="slct chzn-select">
					@foreach($materials as $material)
						<option value="{{ $material->id }}">{{ $material->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="clr"></div>
			<div class="row">
				<div class="label" style="width:85px;">About you : </div>
				<div class="clr"></div>
				<textarea name="about" id="about" class="txt" title="Write something about yourself to be shared with students" style="margin-top:10px; height:100px; width:320px;"></textarea>
			</div>
			<div class="clr"></div>
			<input type="submit" id="d_sbmt2" class="d_sbmt" Value="Next Step ►" />
		</div>

		<div id="step3" class="forms register">
			<h2>Profile Image</h2>
			<small>Upload an Image for your profile, the image should be less than 1MB.</small>
			<div class="row">
				<input type="file" class="file" title="Upload Image" name="r_img" id="r_img" />
			</div>
			<div class="clr"></div>
			<input type="submit" class="d_sbmt" id="d_sbmt3" Value="Finish Registering" />
		</div>
	</form>
	</div><!-- END of forms_container -->
</div>