<style type="text/css">
#message{text-align: left; width:700px; margin:0px auto; color:#FFF; margin-top:50px; }
#message h2{line-height: 26px; font-size:26px;}
#message #body{margin-top:40px; color:#CCC;font-family:Arial, Tahoma, Geneva, sans-serif; font-size:15px; text-align: justify; line-height: 24px; }
#message #body .sign{float:right; color:#f25050; font-style: italic; font-size:12px; margin-top:10px;}
#message #body a{color:#72e700;}
</style>


<a href="{{ URL::home() }}"><div id='r_logo'></div></a>

<div id="message">

	<h2>{{ $m_title }}</h2>
	<div id="body">
		{{ $message }}
	</div>

</div>