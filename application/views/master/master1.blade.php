<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><? if(isset($title))echo $title; else echo 'EL-Handsa'; ?></title>
	<noscript>
  		<meta http-equiv="refresh" content="0;url={{ URL::to('help/enable_javascript') }}">
	</noscript>
	<link rel="icon" href="{{ URL::to('public/img/favicon.ico') }}" type="image/x-icon">
	<link rel="shortcut icon" href="{{ URL::to('public/img/favicon.ico') }}" type="image/x-icon"> 
	{{  HTML::style('public/css/login.css') }}
	@yield('styles')


</head>
<body>

<div id="dead"></div>
<div id="Container">
@yield('content')
</div>

<noscript>
	<a href="{{ URL::to('help/enable_javascript') }}">You need to enable javascript</a>
</noscript>

<!-- MAIN SCRIPTS -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>

@yield('scripts')
</body>
</html>