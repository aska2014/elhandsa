@layout('master.master1')

@section('content')
<div>

	<div id="login" class="forms">
		<h2>Login</h2>
		<font color="#F00" size="2">
			@if(isset($login_errors))
				{{ $login_errors }}
			@endif
		</font>
		<form action="" id="login_form" method="post">
			<div class="row">
				<div class="label">Email : </div>
				<input type="text" value="Email Address" onfocus="if(this.value == 'Email Address')this.value=''" onblur="if(this.value == '')this.value = 'Email Address';" name="email" id="email" class="txt" />
			</div>
			<div class="clr"></div>
			<div class="row">
				<div class="label">Password : </div>
				<input type="password" value="password" onfocus="if(this.value == 'password')this.value=''" onblur="if(this.value == '')this.value = 'password';" name="password" id="password" class="txt" />
			</div>
			<div class="clr"></div>
			<div class="row">
				<input type="checkbox" name="remember" id="remember" style="float:left; margin-left:110px;"/>
				<div style="margin-left:10px; color:#FFF; font-size:12px; float:left;">Remember me on this computer</div>
			</div>
			<div class="clr"></div>
			<input type="submit" class="sbmt" Value="Log In" />
		</form>
	</div>
	<div class="clr"></div>
	<div id="logo"></div>
	<div class="clr"></div>
	<div id="or_register">
		<h2><small>or</small> Register</h2>
		<a href="{{ URL::to('register') }}"><div class="circle" style="margin-left:365px;">Student</div></a>
		<a href="#"><div class="circle">Instructor</div></a>
		<div class="clr"></div>
	</div>

</div>
@endsection
