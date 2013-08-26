<html>
<head>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
		{
			var url = 'http://www.mediafire.com/dynamic/login.php?popup=1';
			var form = $('<form style="display:none" action="' + url + '" name="form_login1" method="post">' +
			  '<input type="text" value="elhandsa2012@yahoo.com" name="login_email">' +
			  '<input type="password" value="portsaid2012" name="login_pass">' +
			  '<input type="checkbox" checked="checked" id="login_remember" name="login_remember">' +
			  '<input type="submit" value="Log in to MediaFire" name="submit_login" id="submit_login">' +
			  '</form>');
			$('body').append(form);
			$(form).submit();
		});
	</script>
	<title></title>
</head>
<body>

</body>
</html>