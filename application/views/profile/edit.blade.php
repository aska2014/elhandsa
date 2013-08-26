<div id="profile" style="width:1000px; margin:0px;">
	<div id="profile_edit">
		<form action="{{ URL::to('profile/edit') }}" id="profile_form" method="POST">
			<h2>Basic Info.</h2>
			@if($success == "basic_success")
				<div class="small" style="color:#090">Basic Info. has been updated successfully</div>
			@endif
			<div class="small">All the bellow info. will be shared with students in your group, also with doctors and professors.</div>
			<div class="row">
				<div class="label">Cell Phone : </div>
				<input type="text" class="txt" value="{{ Auth::user()->cell_phone }}" name="cell_phone" id="profile_cell_phone" />
			</div>
			<div class="row">
				<div class="label">Home Town : </div>
				<input type="text" class="txt" value="{{ Auth::user()->home_town }}" name="home_town" id="profile_home_town" />
			</div>
			<div class="row">
				<div class="label">Hoppies : </div>
				<input type="text" class="txt" value="{{ Auth::user()->hoppies }}" name="hoppies" id="profile_hoppies" />
			</div>
			<div class="row">
				<div class="label">Birth day : </div>
				<select id="profile_birthday_month" name="birthday_month" class="chzn-select" data-placeholder="Month..." style="width:90px;">
					<option value="{{ date('n',strtotime(Auth::user()->birthday)) }}">{{  date('F',strtotime(Auth::user()->birthday))  }}</option>
					<option value="1">January  </option>
			        <option value="2">February </option>
			        <option value="3">March    </option>
			        <option value="4">April    </option>
			        <option value="5">May      </option>
			        <option value="6">June     </option>
			        <option value="7">July     </option>
			        <option value="8">August   </option>
			        <option value="9">September</option>
			        <option value="10">October  </option>
			        <option value="11">November </option>
			        <option value="12">December </option>
				</select>
				<select id="profile_birthday_day" name="birthday_day" class="chzn-select" data-placeholder="Day..." style="width:80px;">
					<option value="{{ date('n',strtotime(Auth::user()->birthday)) }}">{{ date('n',strtotime(Auth::user()->birthday))  }}</option>
					@for($day = 1; $day <= 31; $day++)
						<option value="{{$day}}">{{$day}}</option>
					@endfor
				</select>
			</div>
			<div class="row">
				<div class="label">About : </div>
				<textarea id="profile_about" name="about" class="txt" style="height:100px;" >{{ Auth::user()->about }}</textarea>
			</div>
			<input type="submit" value="Update Your info" class="sbmt" id="profile_submit" />
		</form>

		<form action="{{ URL::to('profile/upload_img') }}" id="profile_form" method="POST" enctype="multipart/form-data">
			<h2>Profile image</h2>
			@if($success == "img_success")
				<div class="small" style="color:#090">Image has been uploaded successfully</div>
			@endif
			<div class="row">
				<div class="label">Profile image : </div>
				<input type="file" name="file" id="profile_file" />
			</div>
			<input type="submit" value="Upload profile image" class="sbmt" id="profile_submit" />
		</form>

		<form action="{{ URL::to('profile/change_password') }}" style="margin-top:25px;" id="profile_form" method="POST" class="form">
			<h2 style="font-size:26px;">Change Password</h2>
			<div class="small">Did your forget your password? <a href="{{ URL::to('forget_password') }}">Click here to get it back</a></div>
			<div class="row">
				<div class="label">Old password : </div>
				<input type="password" class="txt" name="old_password" id="profile_old_password" /><br />
				 <small></small>
			</div>
			<div class="row">
				<div class="label">New password : </div>
				<input type="password" class="txt" name="new_password" id="profile_old_password" />
			</div>
			<div class="row">
				<div class="label">Retype password</div>
				<input type="password" class="txt" name="retype_new_password" id="profile_old_password" />
			</div>
			<input type="submit" value="Change password" class="sbmt" id="profile_submit" />
		</form>
		<div class="clr"></div>
	</div>
</div>