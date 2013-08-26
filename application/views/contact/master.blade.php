@layout('master.master1')

@section('content')
	@include('contact.content')
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js" type="text/javascript"></script>
{{ HTML::script('public/plugins/form/jquery.formLabels1.0.js') }}
<script type="text/javascript">
	$(document).ready(function()
	{
        $.fn.formLabels();
    });
</script>
@endsection