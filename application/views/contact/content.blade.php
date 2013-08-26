<style type="text/css">
.forms{width:450px; margin:0px auto;}
.forms .row{width:400px; float:left;}
.forms .row .txt{width:250px;}

</style>

<div id="r_logo"></div>
<div class="forms">
	<form action="" method="POST" id="contact_form">
		<div class="error"><?php echo implode("<br />" ,$errors->all()) ?></div>
		<div class="row">
			<div class="label">Your name : </div>
			@if(Auth::guest())
				<input name="name" id="c_name" type="text" class="txt" />
			@else
				<input type="text" value="{{ Auth::user()->name() }}" disabled="disabled" class="txt" />
				<input type="hidden" name="name" value="{{ Auth::user()->name() }}" />
			@endif
		</div>
		<div class="clr"></div>
		<div class="row">
			<div class="label">Your E-mail : </div>
			@if(Auth::guest())
				<input name="email" id="c_email" type="text" class="txt" />
			@else
				<input name="email" id="c_email" type="text" value="{{ Auth::user()->email }}" disabled="disabled" class="txt" />
				<input type="hidden" name="email" value="{{ Auth::user()->email }}" />
			@endif
		</div>
		<div class="clr"></div>
		<div class="row">
			<textarea class="txtarea" title="Write your message here" style="height:200px; width:350px;" name="message" id="c_message"></textarea>
		</div>

		<div class="clr"></div>

		<input type="submit" class="sbmt" value="Send Messsage" />

	</form>

</div>