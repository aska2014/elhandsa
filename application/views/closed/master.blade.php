@layout('master.master1')


@section('content')

<div id="logo"></div>
<h2>WE WILL BE BACK AFTER MID-YEAR EXAMS</h2>
<p>
Because we are geeting so close to the mid-year exams, the website will be suspended until the mid-year vacation, In this time alot of modification will be done
to make the website easier to use for both students and doctors. You can leave your email to send you a notification when it's ready :)
</p>

<p>
	Feel free to contact us <a href="{{ URL::to('contact') }}">from here</a>
</p>


<style type="text/css">
a{color:#6F6;}
#logo{margin-top:50px;}
h2{margin-top:50px; margin-bottom:50px;}
p{text-align: left; color:#FFF; font-size:14px; line-height: 22px;}
.forms{width:450px; margin:0px auto;}
.forms .row{width:400px; float:left;}
.forms .row .txt{width:250px;}
</style>
<div class="forms">
	<form action="" method="POST" id="contact_form">
		<div class="error"><?php echo implode("<br />" ,$errors->all()) ?></div>
		@if($success)
		<div class="success">Thanks, we will send you an email as soon as it's ready</div>
		@endif
		<div class="clr"></div>
		<div class="row">
			<div class="label">Your E-mail : </div>
			<input name="email" id="c_email" type="text" class="txt" />
		</div>
		<div class="clr"></div>

		<input type="submit" class="sbmt" value="Submit" />

	</form>

</div>
<h2></h2>

@endsection