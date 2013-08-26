{{ HTML::style('public/plugins/accordion/css/jquery.ui.all.css') }}
{{ HTML::script('public/plugins/accordion/js/jquery.ui.core.js') }}
{{ HTML::script('public/plugins/accordion/js/jquery.ui.widget.js') }}
{{ HTML::script('public/plugins/accordion/js/jquery.ui.accordion.js') }}
<script>
$(function() {
	$( "#accordion").accordion({
		navigation: true
	});
});
</script>